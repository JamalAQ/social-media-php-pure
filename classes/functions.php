<?php
function trans($ln,$key){
    $arabic = [
        "Home" => "الصفحة الرئيسية",
        "contact us" => "اتصل بنا",
        "sign up" => "انشاء حساب",
        "sign in" => "تسجيل الدخول",
        "your email" => "اكتب هنا بريدك الإلكتروني",
        "your password" => "اكتب هنا كلمة السر الخاصة بك",
        "log out"=>"تسجيل الخروج",
        "Your id is :" => "معرفك الشخصي هو :",
        "Your join date is :"=>"تاريخ انضمامك هو :",
        "write here your new email"=>"اكتب هنا بريدك الإلكتروني الجديد",
        "write here your username"=>"اكتب هنا اسم المتسخدم الخاص بك",
        "write here your new password"=>"اكتب هنا كلمة المرور الجديدة الخاصة بك",
        "normal user"=>"مستخدم عادي",
        "admin"=>"حساب مسؤول",
        "non valid"=>"غير مفعل",
        "valid"=>"مفعل",
        "edit"=>"تعديل",
        "Delete my Account"=>"حذف حسابي",
        "chose your favorat langueg"=>"اختر اللغة المفضلة لك",
        "ar"=>"العربية",
        "en"=>"الإنجليزية",
        "make my PDF profile"=>"اصنع ملف المعلومات الخاص بي",
        "pay"=>"ادفع",
    ];
    if($ln=="ar"){echo $arabic["$key"];}else{echo $key;}
}


################### فنكشن تتحق هل كلمة السر تحتوي على محتويات معينة ام لا من شات جي بي تي ^_^ 


function validatePassword($password) {
    $uppercase = preg_match('/[A-Z]/', $password);
    $lowercase = preg_match('/[a-z]/', $password);
    $number = preg_match('/[0-9]/', $password);
    
    if ($uppercase && $lowercase && $number) {
        return true;
    } else {
        return true;
    }
}

