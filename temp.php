echo "
                                                        <html>
                                                        <head>
                                                        <script>
                                                        <link rel='stylesheet' href='bootstrap-toastr/toastr.min.css'>
                                                                toastr.options = {
                                                                'closeButton': true,
                                                                'debug': false,
                                                                'newestOnTop': true,
                                                                'progressBar': true,
                                                                'positionClass': 'toast-top-right',
                                                                'preventDuplicates': false,
                                                                'onclick': null,
                                                                'showDuration': '300',
                                                                'hideDuration': '1000',
                                                                'timeOut': '5000',
                                                                'extendedTimeOut': '1000',
                                                                'showEasing': 'swing',
                                                                'hideEasing': 'linear',
                                                                'showMethod': 'fadeIn',
                                                                'hideMethod': 'fadeOut'
                                                                }

                                                        </script>
                                                        </head>
                                                        <body>
                                                        toastr['success']('Trek Created Successfully');
                                                        
                                                        <script src='bootstrap-toastr/toastr.min.js'></script>
                                                        </body>
                                                        
                                                        </html>";