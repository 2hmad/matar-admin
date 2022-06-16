<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>اعادة تعيين كلمة المرور</title>
</head>

<body>
    <p>اهلاً {{ $name }},</p>
    <p>
        طلب أحد ما إعادة تعيين كلمة المرور للحساب التالي :
    </p>
    <p>
        اسم المستخدم : {{ $email }}
    </p>

    <p>----------------</p>

    <p>
        لاعادة تعيين كلمة المرور ، قم باستخدام الكود التالي :
    </p>

    <p>الكود المستخدم : {{ $code }}</p>

    <p>----------------</p>

    <p>
        إذا كان هذا خطأ، فقط تجاهل هذه الرسالة ولن يحدث شئ.
    </p>
</body>

</html>
