<?php

namespace Sarfraznawaz2005\BackupManager\Http\Controllers;

use App\Models\DatabaseInformation;
use App\Models\DeliveryInformation;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Routing\Controller as BaseController;
use Log;
use Sarfraznawaz2005\BackupManager\Facades\BackupManager;
use Illuminate\Support\Facades\DB;
use Session;
use Storage;


class BackupManagerController extends BaseController
{
    public function __construct()
    {
    }

    public function index()
    {
        $title = 'Backup List';

        $backups = BackupManager::getBackups();
        // dd($backups);

        return view('backupmanager::index', compact('title', 'backups'));
    }

    public function updateDbFile(Request $request)
    {

        //dd($request->all());
        DB::table('database_information')->where('name',$request->db_name)->update(['name'=> $request->db_name_edit . ".gz"]);
        DB::table('database_information')->where('database_storage_name',$request->db_name)->update(['database_storage_name'=> $request->db_name_edit . ".gz"]);
        DB::connection('mysql2')->table('database_information')->where('name',$request->db_name)->update(['name'=> $request->db_name_edit . ".gz"]);
 
       DB::connection('mysql2')->table('database_information')->where('database_storage_name',$request->db_name)->update(['database_storage_name'=> $request->db_name_edit . ".gz"]);

        
        $check = BackupManager::updatedb($request->db_name, $request->db_name_edit . ".gz");
        // dd($check);
        if ($check === "y") {
            $message = 'Database Updated Successfully';
            
            $messages[] = [
                'type' => 'success',
                'message' => $message
            ];
            
            // return response()->json("Database Updated Successfully");
        } else {
            $message = 'Database Updated Failed';

            $messages[] = [
                'type' => 'danger',
                'message' => $message
            ];
            
            // return response()->json("Database Updated Failed");
        }
        //Session::flash('messages', $messages);

        \Session::flash('messages', $messages);

        return redirect()->back();
        
    }

    public function createBackup(Request $request)
    {
        // dd($request->all());
        $message = '';
        $mailBody = '';
        $messages = [];
        $num = time();
        // create backups
        $result = BackupManager::createBackup($num, $request->db_name);
        // dd($result);

        //  dd($result);

        // set status messages
        // if ($result['f'] === true) {
        //     $message = 'Files Backup Taken Successfully';

        //     $messages[] = [
        //         'type' => 'success',
        //         'message' => $message
        //     ];

        //     Log::info($message);
        // } else {
        //     if (config('backupmanager.backups.files.enable')) {
        //         $message = 'Files Backup Failed';

        //         $messages[] = [
        //             'type' => 'danger',
        //             'message' => $message
        //         ];

        //         Log::error($message);
        //     }
        // }

        $mailBody .= $message;
        // dd($result);
        if ($result['d'] === true) {

            $message = 'Database Backup Taken Successfully';

            $messages[] = [
                'type' => 'success',
                'message' => $message
            ];

            Log::info($message);
        } else {
            if (config('backupmanager.backups.database.enable')) {
                $message = 'Database Backup Failed';

                $messages[] = [
                    'type' => 'danger',
                    'message' => $message
                ];

                Log::error($message);
            }
        }

        // $mailBody .= '<br>' . $message;

        // $this->sendMail($mailBody);

        \Session::flash('messages', $messages);

        return redirect()->back();
    }

    public function restoreOrDeleteBackups()
    {
        // DB::table('database_information')->where('name',$request->db_name)->update(['name'=> $request->db_name_edit . ".gz"]);
        // DB::table('database_information')->where('database_storage_name',$request->db_name)->update(['database_storage_name'=> $request->db_name_edit . ".gz"]);
        // dd(request()->all());
        $mailBody = '';
        $messages = [];
        $backups = request()->backups;
        $type = request()->type;
        //   DB::table('database_information')->insert( ['name' => $backups, 'status' => '1','database_storage_name' => $backups]);

        // dd(request()->backups);

        // if ($type === 'restore' && count($backups) > 1) {
        //     $messages[] = [
        //         'type' => 'danger',
        //         'message' => 'Max of two backups can be restored at a time.'
        //     ];

        //     Session::flash('messages', $messages);
        //     return redirect()->back();
        // }

        if ($type === 'restore') {
            // restore backups
    
            $results = BackupManager::restoreBackups($backups);
            //  dd($results);
            // set status messages
            foreach ($results as $result) {
                if (isset($result['f'])) {
                    if ($result['f'] === true) {

                        $message = 'Files Backup Restored Successfully';

                        $messages[] = [
                            'type' => 'success',
                            'message' => $message
                        ];

                        Log::info($message);
                    } else {
                        $message = 'Files Restoration Failed';

                        $messages[] = [
                            'type' => 'danger',
                            'message' => $message
                        ];

                        Log::error($message);
                    }

                    $mailBody .= $message;
                } elseif (isset($result['d'])) {
                    if ($result['d'] === true || $result['d'] === false) {
                        $message = 'Database Backup Restored Successfully';
                        $messages[] = [
                            'type' => 'success',
                            'message' => $message
                        ];
                        $db_info = DatabaseInformation::where('status', 1)->get();
                        if (count($db_info) > 0) {
                            foreach ($db_info as $db_info_item) {
                                DatabaseInformation::find($db_info_item->id)->update(['status' => 0]);
                            }
                        }
                        $db_status = DatabaseInformation::create(['name' => $backups, 'status' => 1, 'database_storage_name' => $backups]);


                        Log::info($message);
                    } else {
                        $message = 'Database Restoration Failed';

                        $messages[] = [
                            'type' => 'danger',
                            'message' => $message
                        ];

                        Log::error($message);
                    }

                    $mailBody .= '<br>' . $message;
                }
            }

            $this->sendMail($mailBody);
        } else {
            // delete backups

            $results = BackupManager::deleteBackups($backups);

            if ($results) {
                DatabaseInformation::where('database_storage_name', $backups)->delete();
                $messages[] = [
                    'type' => 'success',
                    'message' => 'Backup(s) deleted successfully.'
                ];
            } else {
                $messages[] = [
                    'type' => 'danger',
                    'message' => 'Deletion failed.'
                ];
            }
        }

        Session::flash('messages', $messages);

        return redirect()->back();
    }

    public function download($file)
    {
        $path = config('backupmanager.backups.backup_path') . DIRECTORY_SEPARATOR . $file;

        $file = Storage::disk(config('backupmanager.backups.disk'))
            ->getDriver()
            ->getAdapter()
            ->getPathPrefix() . $path;

        return response()->download($file);
    }

    protected function sendMail($body)
    {
        try {

            $emails = config('backupmanager.mail.mail_receivers', []);

            if ($emails) {
                foreach ($emails as $email) {
                    \Mail::send([], [], static function (Message $message) use ($body, $email) {
                        $message
                            ->subject(config('backupmanager.mail.mail_subject', 'BackupManager Alert'))
                            ->to($email)
                            ->setBody($body, 'text/html');
                    });
                }
            }
        } catch (\Exception $e) {
            \Log::error('BackupManager Email Sending Failed: ' . $e->getMessage());
        }
    }



    public function resetData()
    {
        // \DB::table('associations')->truncate();
        // \DB::table('brands')->truncate();

        // \DB::table('countries')->truncate();
        // \DB::table('coupons')->truncate();

        // \DB::table('coupon_influencers')->truncate();
        // \DB::table('images_gallery')->truncate();
        // \DB::table('influencers')->truncate();
        // $messages[] = [
        //     'type' => 'success',
        //     'message' => 'Database Reset Successfully.'
        // ];
        // Session::flash('messages', $messages);

        return redirect()->back();
    }
}
