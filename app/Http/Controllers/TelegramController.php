<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelegramController extends Controller
{
    //
    public function send_msg(Request $request){
        $msg = $request->msg;
        // $chatID = "-241176998";
        $chatID = "504533508";
        $token = "603092158:AAFB6qrAxPLZt1xTcfOeb3GRTqQ0fYtVUVY";
        $messaggio = $msg;


                
        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
        $url = $url."&text=".$messaggio;
        
        //$result = file_get_contents($url);
        
        $ch = curl_init();
        $optArray = array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true
                    );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);
                
        
        
        print_r($result);
        return "end";
    }


    public function send_msg_post(Request $request){
        $msg = $request->msg;
        $chatID = "-241176998";
        //$chatID = "504533508";
        $token = "603092158:AAFB6qrAxPLZt1xTcfOeb3GRTqQ0fYtVUVY";
        $messaggio = $msg;


                
        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
        $url = $url."&text=".$messaggio;
        
        //$result = file_get_contents($url);
        
        $ch = curl_init();
        $optArray = array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true
                    );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);
                
        
        
        print_r($result);
        return "end";
    }

    public function send_msg_to_group(Request $request){
        $msg = $request->msg;
        $chatID = $request->chat_id;
        //$chatID = "-241176998";
        //$chatID = "504533508";
        $token = "603092158:AAFB6qrAxPLZt1xTcfOeb3GRTqQ0fYtVUVY";
        $messaggio = $msg;


                
        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
        $url = $url."&text=".$messaggio;



        // $result = file_get_contents($url);
        
        $ch = curl_init();
        $optArray = array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true
                    );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);
        
        $validation = $this->validate_telegram_response($result);
		if(!$validation){
			$this->notify_error($chatID,$result);
		}
        
        
        //print_r($result);
        return $result;
    }

    public function unms_group_msg(Request $request){
        $msg = $request->msg;
        $chatID = $request->chat_id;
        //$chatID = "-241176998";
        //$chatID = "504533508";
        $token = "603092158:AAFB6qrAxPLZt1xTcfOeb3GRTqQ0fYtVUVY";
        $messaggio = $msg;


                
        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
        $url = $url."&text=".urlencode($messaggio);

        //return $url;

        // $result = file_get_contents($url);
        
        $ch = curl_init();
        $optArray = array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true
                    );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);
        
        $validation = $this->validate_telegram_response($result);
        if(!$validation){
            $this->notify_error($chatID,$result);
        }
        
        
        //print_r($result);
        return $result;
    }


    public function send_msg_decode(Request $request){
        $msg = urldecode ($request->msg);
        $chatID = $request->chat_id;
        //$chatID = "-241176998";
        //$chatID = "504533508";
        $token = "603092158:AAFB6qrAxPLZt1xTcfOeb3GRTqQ0fYtVUVY";
        $messaggio = utf8_encode($msg);


                
        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
        $url = $url."&text=".$messaggio;
        
        //$result = file_get_contents($url);
        
        $ch = curl_init();
        $optArray = array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true
                    );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);
        
        $validation = $this->validate_telegram_response($result);
		if(!$validation){
			$this->notify_error($chatID,$result);
		}
        
        
        //print_r($result);
        return $result;
    }

    public function send_html_msg_to_group(Request $request){
        $msg = $request->msg;
        $chatID = $request->chat_id;
        //$chatID = "-241176998";
        //$chatID = "504533508";
        $token = "603092158:AAFB6qrAxPLZt1xTcfOeb3GRTqQ0fYtVUVY";
        $messaggio = $msg;


                
        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
        $url = $url."&text=".$messaggio."&parse_mode=HTML";
        
        //$result = file_get_contents($url);
        
        $ch = curl_init();
        $optArray = array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true
                    );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);
                
        
        
        //print_r($result);
        return $result;
    }

    // public function test_msg(){
	// 	// Hr Tool Notification = -380282172 => -1001329204475
	// 	// ITC = -344295362 => -1001457581366
	// 	// IIG = -336312938 => -1001291937985
	// 	// ICX = -367223919 => -1001159867913
	// 	// SCL NOC = -241176998
	// 	// Error Notification = -351623299
	// 	// RIO-4 = -266375043 => -1001328066276

	// 	$result = $this->send_telegram_notification("ping test from 80","-266375043");
	// 	///////////////////////////
	// 	$validation = $this->validate_telegram_response($result);
	// 	if(!$validation){
	// 		$this->notify_error("-266375043",$result);
	// 	}
	// 	return $result;
	// }

	public function validate_telegram_response($response){
		////////////////////////// Sample success json ////////////////////////////////
		// {"ok":true,"result":{"message_id":1316,"from":{"id":603092158,"is_bot":true,"first_name":"IncidentNotifier","username":"IncidentNotifierBot"},"chat":{"id":-351623299,"title":"ErrorNotification","type":"group","all_members_are_administrators":true},"date":1549513898,"text":"test from 80"}}
		///////////////////////////Sample Error Json  /////////////////////////////////
		// {"ok":false,"error_code":400,"description":"Bad Request: group chat was upgraded to a supergroup chat","parameters":{"migrate_to_chat_id":-1001328066276}}
		///////////////////////////////////////////////////////////////////////////////
		
		$response_array = json_decode($response,true);
		$response_type = $response_array["ok"];
		return $response_type; 
	}

	public function notify_error($request,$response){
		// $this->send_telegram_notification($request,"-351623299");
        // $this->send_telegram_notification($response,"-351623299");
        
        ////////////////////// Send Chat id first /////////////////////
        $msg = $request;
        $chatID = "-351623299";
        $token = "603092158:AAFB6qrAxPLZt1xTcfOeb3GRTqQ0fYtVUVY";
        $messaggio = $msg;

        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
        $url = $url."&text=".$messaggio;
        $ch = curl_init();
        $optArray = array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true
                    );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);

        ////////////////// Send Error Response /////////////////////////
        $msg = $response;
        $chatID = "-351623299";
        $token = "603092158:AAFB6qrAxPLZt1xTcfOeb3GRTqQ0fYtVUVY";
        $messaggio = $msg;

        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
        $url = $url."&text=".$messaggio;
        $ch = curl_init();
        $optArray = array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true
                    );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);

        /////////////////// Update Chat Id //////////////////////////////
        // $response_array = json_decode($msg,true);
        // if(isset($response_array["parameters"])){
        //     $parameters = $response_array["parameters"];
        //     if(isset($parameters["migrate_to_chat_id"])){
        //         $migrate_chat_id = $parameters["migrate_to_chat_id"];


        //         $url = "http://172.16.136.80/scl_sms_system/public/update_chat_id?current_chat_id=$request&update_chat_id=$migrate_chat_id";
        //         $ch = curl_init();
        //         $optArray = array(
        //                     CURLOPT_URL => $url,
        //                     CURLOPT_RETURNTRANSFER => true
        //                     );
        //         curl_setopt_array($ch, $optArray);
        //         $result = curl_exec($ch);
        //         curl_close($ch);


        //         //echo()
        //         //$response = file_get_contents("http://172.16.136.80/scl_sms_system/public/update_chat_id?current_chat_id=$request&update_chat_id=$migrate_chat_id");
        //         ///////////////////////// Send update notification //////////////////////
        //         //$msg = "http://172.16.136.80/scl_sms_system/public/update_chat_id?current_chat_id=$request&update_chat_id=$migrate_chat_id";
        //         $msg = "Chat id $request is updated with chat id $migrate_chat_id";
        //         $msg = $result;
        //         $chatID = "-351623299";
        //         $token = "603092158:AAFB6qrAxPLZt1xTcfOeb3GRTqQ0fYtVUVY";
        //         $messaggio = $msg;

        //         $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
        //         $url = $url."&text=".$messaggio;
        //         $ch = curl_init();
        //         $optArray = array(
        //                     CURLOPT_URL => $url,
        //                     CURLOPT_RETURNTRANSFER => true
        //                     );
        //         curl_setopt_array($ch, $optArray);
        //         $result = curl_exec($ch);
        //         curl_close($ch);


        //     }
        // }


		return true;
    }
    

}
