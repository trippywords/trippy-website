<?php

namespace App\Helpers;

use Config;
use Mail;

class Email_sender
{

    public static function sendContactUsEmailToUser($data = null)
    {
        if ($data != null) 
        {
            $settings                 = [];
            $settings['data']         = $data;
            $settings['fromEmail']    = 'no-reply@stayrunners.com';
            $settings['toEmail']      = $data->varEmail;
            $settings['senderName']   = 'StayRunners Team';
            $settings['receiverName'] = $data->varName;
            $settings["subject"] = "Thank you for contacting Stay Runners";
            $settings['emailType'] = 'Contact Us';
            $settings['from'] = $settings['fromEmail'];
            $settings['to'] = $settings['toEmail'];
            $settings['sender'] = $settings['senderName'];
            $settings['receiver'] = $settings['receiverName'];
            $settings['txtBody'] = view('emails.user_contact_us_email', $settings)->render();
            unset($settings['txtBody']);
            Self::sendEmail('emails.user_contact_us_email', $settings);
        }
    }

    public static function sendContactUsEmailToAdmin($data = null)
    {
        if ($data != null) 
        {
            $settings                 = [];
            $settings['data']         = $data;
            $settings['fromEmail']    = 'no-reply@stayrunners.com';
            $settings['toEmail']      = 'admin@stayrunnrs.com';
            $settings['senderName']   = 'StayRunners Team';
            $settings['receiverName'] = 'Stayrunners Admin';
            $settings["subject"] = "New Contact Enquiry received";
            $settings['emailType'] = 'Contact Us Lead';
            $settings['from'] = $settings['fromEmail'];
            $settings['to'] = $settings['toEmail'];
            $settings['sender'] = $settings['senderName'];
            $settings['receiver'] = $settings['receiverName'];
            $settings['txtBody'] = view('emails.admin_contact_us_email', $settings)->render();
            unset($settings['txtBody']);
            Self::sendEmail('emails.admin_contact_us_email', $settings);
        }
    }


    public static function sendSubscriptionEmail($data = null, $encID = false)
    {
        if ($data != null) {

            $settings                 = [];
            $settings['data']         = $data;
            $settings['encryptedID']  = $encID;
            $settings['fromEmail']    = 'no-reply@stayrunners.com';
            $settings['toEmail']      = $data['varEmail'];
            $settings['senderName']   = 'StayRunners Team';
            $settings['receiverName'] = explode('@',$data['varEmail'])[0];
            $settings["subject"]      = "Congratulations! You have successfully subscribed";
            $settings['emailType']    = 'Subscription';
            $settings['from']         = $settings['fromEmail'];
            $settings['to']           = $settings['toEmail'];
            $settings['sender']       = $settings['senderName'];
            $settings['receiver']     = $settings['receiverName'];
            $settings['txtBody']      = view('emails.subscription_email', $settings)->render();
            unset($settings['txtBody']);
            Self::sendEmail('emails.subscription_email', $settings);
        }
    }

    public static function sendHotelRegistrationEmail($data = null)
    {
        if ($data != null) 

            $settings                 = [];
            $settings['data']         = $data;
            $settings['fromEmail']    = 'no-reply@stayrunners.com';
            $settings['toEmail']      = $data['hotel_email'];
            $settings['senderName']   = 'StayRunners Team';
            $settings['receiverName'] = $data['hotel_name'];
            $settings["subject"] = "Thank you for Registering Accomodation";
            $settings['emailType'] = 'Accomodation Registration';
            $settings['from'] = $settings['fromEmail'];
            $settings['to'] = $settings['toEmail'];
            $settings['sender'] = $settings['senderName'];
            $settings['receiver'] = $settings['receiverName'];
            $settings['txtBody'] = view('emails.hotel_registartion_email', $settings)->render();
            unset($settings['txtBody']);
            Self::sendEmail('emails.hotel_registartion_email', $settings);
        }
    


    public static function sendSupplierRegistrationEmail($data = null)
    {
        if ($data != null) {
            $settings                 = [];
            $settings['data']         = $data;
            $settings['fromEmail']    = 'no-reply@stayrunners.com';
            $settings['toEmail']      = $data['supplier_email'];
            $settings['senderName']   = 'StayRunners Team';
            $settings['receiverName'] = $data['supplier_name'];
            $settings["subject"] = "Thank you for Registering Your Self as Supplier";
            $settings['emailType'] = 'Supplier Registration';
            $settings['from'] = $settings['fromEmail'];
            $settings['to'] = $settings['toEmail'];
            $settings['sender'] = $settings['senderName'];
            $settings['receiver'] = $settings['receiverName'];
            $settings['txtBody'] = view('emails.supplier_registartion_email', $settings)->render();
            unset($settings['txtBody']);
            Self::sendEmail('emails.supplier_registartion_email', $settings);
        }
    }

    public static function sendRunnerRegistrationEmail($data = null)
    {
        if ($data != null) {
            $settings = [];
            $settings['data'] = $data;
            $settings['fromEmail'] = 'no-reply@stayrunners.com';
            $settings['toEmail'] = $data['runner_email'];
            $settings['senderName'] = 'Cosmonaute Group';
            $settings['receiverName'] = $data['runner_name'];
            $settings["subject"] = "Thank you for Registering Your Self as Runner";
            $settings['emailType'] = 'Runner Registration';
            $settings['from'] = $settings['fromEmail'];
            $settings['to'] = $settings['toEmail'];
            $settings['sender'] = $settings['senderName'];
            $settings['receiver'] = $settings['receiverName'];
            $settings['txtBody'] = view('emails.runner_registartion_email', $settings)->render();
            unset($settings['txtBody']);
            Self::sendEmail('emails.runner_registartion_email', $settings);
        }
    }

    public static function sendFrontUserRegistrationEmail($data = null)
    {

        if ($data != null) {
            $settings                 = [];
            $settings['data']         = $data;
            $settings['fromEmail']    = 'no-reply@stayrunners.com';
            $settings['toEmail']      = $data['email'];
            $settings['senderName']   = 'StayRunners Team';
            $settings['receiverName'] = $data['name'];
            $settings["subject"] = "Thank you for Registration";
            $settings['emailType'] = 'User Registration';
            $settings['from'] = $settings['fromEmail'];
            $settings['to'] = $settings['toEmail'];
            $settings['sender'] = $settings['senderName'];
            $settings['receiver'] = $settings['receiverName'];
            $settings['txtBody'] = view('emails.front_user_registartion_email', $settings)->render();
            unset($settings['txtBody']);
            Self::sendEmail('emails.front_user_registartion_email', $settings);
        }
    }

    public static function sendEmail($view = null, $settings = null)
    {
        if (!empty($settings) && $view != null) {
            $sent = Mail::send($view, $settings, function ($message) use ($settings) {
                $message->from($settings['from'], $settings['sender']);
                $message->to($settings['to'], $settings['receiver'])->subject($settings['subject']);
            });
        }
    }

    public static function sendEmailForFrontUserBookingWithSignup($data = null,$password = null)
    {
        if ($data != null) {
            $settings = [];
            $settings['data'] = $data;
            $settings['original_password'] = $password;
            $settings['fromEmail']    = 'no-reply@stayrunners.com';
            $settings['toEmail']      = $data['user_email'];
            $settings['senderName']   = 'StayRunners Team';
            $settings['receiverName'] = $data['user_name'];
            $settings["subject"] = "Thank you for Registration";
            $settings['emailType'] = 'User Registration';
            $settings['from'] = $settings['fromEmail'];
            $settings['to'] = $settings['toEmail'];
            $settings['sender'] = $settings['senderName'];
            $settings['receiver'] = $settings['receiverName'];
            $settings['txtBody'] = view('emails.front_user_booking_with_signup_email', $settings)->render();
            unset($settings['txtBody']);
            Self::sendEmail('emails.front_user_booking_with_signup_email', $settings);
        }
    }

    public static function sendOrderNotificationEmailToSuppliers($data = null)
    {        
        if ($data != null) 
        {
            $settings                 = [];
            $settings['data']         = $data;
            $settings['fromEmail']    = $data->fromEmail;
            $settings['toEmail']      = $data->varEmail;
            $settings['senderName']   = $data->senderName;
            $settings['receiverName'] = $data->varName;
            $settings['order_id'] = $data->order_id;
            $settings['orderData'] = $data->orderData;
            $settings["subject"]      = "New Order Requst";
            $settings['emailType']    = 'Order Requst';
            $settings['order_id']     = $settings['order_id'];
            $settings['from']         = $settings['fromEmail'];
            $settings['to']           = $settings['toEmail'];
            $settings['sender']       = $settings['senderName'];
            $settings['receiver']     = $settings['receiverName'];
            $settings['txtBody']      = view('emails.new_order_notification_to_supplier', $settings)->render();
            unset($settings['txtBody']);                        
            Self::sendEmail('emails.new_order_notification_to_supplier', $settings);
        }
    }

    public static function sendOrderConfirmationEmailToUser($data = null)
    {
        if ($data != null) 
        {
            $settings                 = [];
            $settings['data']         = $data;
            $settings['fromEmail']    = $data->fromEmail;
            $settings['toEmail']      = $data->varEmail;
            $settings['senderName']   = $data->senderName;
            $settings['receiverName'] = $data->varName;
            $settings["subject"]      = "Order Confirmation";
            $settings['emailType']    = 'Order Confirmation';
            $settings['from']         = $settings['fromEmail'];
            $settings['to']           = $settings['toEmail'];
            $settings['sender']       = $settings['senderName'];
            $settings['receiver']     = $settings['receiverName'];
            $settings['txtBody']      = view('emails.order_confirmation_to_user', $settings)->render();
            unset($settings['txtBody']);
            Self::sendEmail('emails.order_confirmation_to_user', $settings);
        }
    }

    public static function sendOrderCancellationEmailToUser($data = null)
    {
        if ($data != null) 
        {
            $settings                 = [];
            $settings['data']         = $data;
            $settings['fromEmail']    = $data->fromEmail;
            $settings['toEmail']      = $data->varEmail;
            $settings['senderName']   = $data->senderName;
            $settings['receiverName'] = $data->varName;
            $settings["subject"]      = "Order Confirmation";
            $settings['emailType']    = 'Order Confirmation';
            $settings['from']         = $settings['fromEmail'];
            $settings['to']           = $settings['toEmail'];
            $settings['sender']       = $settings['senderName'];
            $settings['receiver']     = $settings['receiverName'];
            $settings['txtBody']      = view('emails.order_cancel_to_user', $settings)->render();
            unset($settings['txtBody']);
            Self::sendEmail('emails.order_cancel_to_user', $settings);
        }
    }
    public static function sendHotelregisterbyadminEmailToUser($data = null)
    {
       
        if ($data != null) 
        {
            $settings                 = [];
            $settings['data']         = $data;
            $settings['fromEmail']    = 'no-reply@stayrunners.com';
            $settings['toEmail']      = $data->varEmail;
            $settings['senderName']   = 'Admin';
            $settings['receiverName'] = $data->varName;
            $settings['password']     = $data->varPassword;
            $settings["subject"]      = "Accommodation Signup Email";
            $settings['emailType']    = 'Accommodation Signup Email';
            $settings['from']         = $settings['fromEmail'];
            $settings['to']           = $settings['toEmail'];
            $settings['sender']       = $settings['senderName'];
            $settings['receiver']     = $settings['receiverName'];
            $settings['txtBody']      = view('emails.hotel_registerbyadmin_email', $settings)->render();
            unset($settings['txtBody']);
            Self::sendEmail('emails.hotel_registerbyadmin_email', $settings);
        }
    }
    
    
}
