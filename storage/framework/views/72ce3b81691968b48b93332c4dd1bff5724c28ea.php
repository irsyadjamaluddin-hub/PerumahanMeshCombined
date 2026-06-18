<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>

    <style>
        .check {
            border: 1px solid red;
        }
    </style>
</head>

<body style="
    font-family: Tahoma, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
">

<?php
    $purple = "#4c00b0";
?>

<table cellspacing="0" cellpadding="0" align="center"
style="
    width: 100%;
    table-layout: fixed;
    padding: 0;
    margin: 0;
">

    <tr>
        <td align="center" valign="top" colspan="2">

            <table class="" cellspacing="0" cellpadding="0" align="center" style="
                overflow: hidden;
            ">

                
                <div style="margin-top: 0em;"></div>

                
                <tr>
                    <td
                    style="
                        background-color: #ffffff;
                        padding: 30px;
                        max-width: 500px;
                        text-align: justify;
                        line-height: 1.5;
                        border: 1px solid <?php echo e($purple); ?>;
                    "
                    align="center">

                        <!-- MESH Logo -->
                        <div style="
                            display: block;
                            text-align: center;
                            padding: 0;
                            margin: 0 0 3em 0;
                        " class="">
                            <p style="
                                font-weight:600;
                                font-size: 51px;
                                padding:0;
                                margin:0;
                                line-height: 1;
                                color: <?php echo e($purple); ?>;
                                /* color: #301934; */
                            ">MESH</p>

                            <p style="
                                font-size: 10px;
                                padding:0;
                                margin:0;
                                line-height: 1.2;
                            ">MOE Employee and Services Hub</p>
                        </div>
                        
                        
                        <div style="margin-top: 2em;"></div>

                        
                        <p style="padding:0; margin:0;">Yang Mulia Pengiran / Tuan / Puan,</p>

                        
                        <div style="text-align: left;">
                            <p style="font-weight: 600; padding:0; margin:0; line-height: 1.5;"><?php echo e(ucwords($notf_Nama)); ?></p>
                            <p style="padding:0; margin:0; line-height: 1.5;"><?php echo e($notf_jabatan); ?></p>
                        </div>

                        
                        <div style="margin-top: 3em">
                            <p>Your registration has been successfully completed. Please note that it is currently <span style="font-weight: 600; text-decoration: underline;">under review and pending approval</span>. This process may take 1 to 3 days </p>

                            <p style="margin-top: 1em;">
                                If you have any questions or require further assistance, feel free to reach out to our support team at
                                <span style="text-decoration: underline; color: blue;">tpp@moe.gov.bn</span>.
                            </p>
                        </div>

                        
                        <div style="
                            margin-top: 3em;
                        ">
                            <p style="
                                padding:0;
                                margin:0;
                                line-height: 1.5;
                            ">Best Regards,</p>
                            <p style="
                                padding:0;
                                margin:0;
                                line-height: 1.5;
                            ">MESH Support Team</p>
                        </div>
                    </td>
                </tr>

            </table>

        </td>

    </tr>

</table>

</body>
</html>
<?php /**PATH S:\Mesh110626\resources\views/emails/notification/EmailRegister.blade.php ENDPATH**/ ?>