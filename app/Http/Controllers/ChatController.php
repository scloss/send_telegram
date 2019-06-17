<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DateTime;
use DateTimezone;
use DB;


class ChatController extends Controller
{
    //
    public function chatup(){
        //return "success";
        //-------------------Get Last Update ID------------------------------------------
        //$last_update_id_temp = Redis::get('last_update_id');
        $last_update_id = 182275578;
        $bot_token = "603092158:AAFB6qrAxPLZt1xTcfOeb3GRTqQ0fYtVUVY";
        //------------------ Get New Updates -------------------------------------------
        
        $get_update_json = file_get_contents("https://api.telegram.org/bot$bot_token/getUpdates?offset=$last_update_id");
        echo "URL:  ";
        echo "<br>";
        echo "https://api.telegram.org/bot$bot_token/getUpdates?offset=$last_update_id";
        echo "<br>";
        echo $get_update_json;
        echo "<br>";

        $msg_updates = json_decode($get_update_json,true);
        $msg_array = $msg_updates['result'];
        
        
        If(count($msg_array)>0){
            
            //------------------ Read Updates ----------------------------------------------
            foreach($msg_array as $msg ){
                //---------------  validate if user is Registered------------------------------- 
                // $GLOBALS['user_valid_flag'] = "invalid";

                // $user_list = Redis::get('users');
                // $user_array = json_decode($user_list,true);

                // $telegram_id = $msg['message']['from']['id'];

                // //dd($telegram_id);

                // if(isset($user_array[$telegram_id])){
                //     $GLOBALS['user_valid_flag'] = "valid";    
                // }

                // foreach($user_array as $user){
                //     if($telegram_id == $user){
                //         $GLOBALS['user_valid_flag'] = "valid";
                //     }
                // }



                if(isset($msg['update_id'])){
                    $update_id_temp = $msg['update_id'];    
                }
                else{
                    $update_id_temp = 0;
                }
                if(isset($msg['message']['chat']['id'])){
                    $chat_id_temp = $msg['message']['chat']['id'];
                }
                else{
                    $chat_id_temp = 0;
                }

                if(isset($msg['message']['chat']['title'])){
                    $chat_title_temp = $msg['message']['chat']['title'];
                }
                else{
                    $chat_title_temp = "";
                }



                if(isset($msg['message']['from']['first_name'])){
                    $first_name_temp = $msg['message']['from']['first_name'];
                }else{
                    $first_name_temp = 'NA';
                }
                if(array_key_exists('last_name', $msg['message']['from'])){
                    $last_name_temp = $msg['message']['from']['last_name'];
                }
                else{
                    $last_name_temp = 'NA';
                }
                
                if(isset($msg['message']['text'])){
                    $message_temp = $msg['message']['text'];
                }else{
                    $message_temp = 'NA';
                }
                if(isset($msg['message']['date'])){
                    $date = $msg['message']['date'];
                    //date_default_timezone_set("Asia/Dhaka");
                    $dt = new DateTime("@$date",new DateTimezone('Asia/Dhaka'));  // convert UNIX timestamp to PHP DateTime
                    $date_temp = $dt->format('Y-m-d H:i:s');
                }else{
                    $date_temp = '0000-00-00 00:00:00';
                }
                //--------------- Prepare Reply -------------------------
                //$reply = $this->prepare_reply($message_temp);

                if($message_temp == "GET CHAT ID"){
                    //-------------- Send Reply -----------------------------
                    $message_send_response = $this->sendMessage($chat_id_temp,$chat_id_temp, $bot_token);
                    echo "<br>";
                    echo $message_send_response;
                    echo "<br>";
                }
                else if($message_temp == "REGISTER CHAT"){
                    $insert_ticket_table_query = "INSERT INTO telegram_db.telegram_group_table(group_name,chat_id) VALUES ('$chat_title_temp','$chat_id_temp')";
                    \DB::insert(\DB::raw($insert_ticket_table_query));

                    echo "registered $chat_title_temp <br/>";
                }
                else{

                }
                
                
                
            }

        }
        else{
            echo "No new Message";
        }
    }


    //------------------- Utility Functions ----------------------
    public function sendMessage($chatID, $messaggio, $token) {
        echo "<br>";
        echo "sending message to " . $chatID;

        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
        $url = $url . "&text=" . urlencode($messaggio);//. "&reply_markup=" .$keyboard_json;
        $ch = curl_init();
        $optArray = array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    //------------------------------------------------------------
    public function prepare_reply($msg){

    }
}
