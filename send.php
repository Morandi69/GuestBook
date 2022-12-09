<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Оставтье отзыв</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <h2>Оставтье отзыв</h2>
    <form class="my-form" action="sender.php" method="post" enctype="multipart/form-data" style="margin-left:10px; margin-right:10px">    
        <label for="name">Username:</label>
        <input class="form-control" name="username" />
           
        <label for="email">Email:</label>
        <input id="emailinput" class="form-control" name="email" />
    
        <label for="homepage">HomePage:</label>
        <input class="form-control" name="homepage" />
     
        <label for="message">Message:</label><br>

        <button type="button" onclick="code()" class="btn btn-info">[code]</button>
        <button type="button" onclick="italic()" class="btn btn-info">[italic]</button>
        <button type="button" onclick="strike()" class="btn btn-info">[strike]</button>
        <button type="button" onclick="strong()" class="btn btn-info">[strong]</button>
        <div style="color:red;" id="valid"></div>

        <textarea id="textarea" style="margin-top:5px" class="form-control" name="message"></textarea>
        
        <input style="margin-top:5px;"  type="file"  name="file">

        <div style="margin-top:5px" class="g-recaptcha" data-sitekey="6LdFCU4jAAAAAIZ3j4Gc1bq_KYtQHbIHN7cED3IK"></div>

        <button style="margin-top:5px; " class="btn btn-sm btn-primary" type="submit" name="submit" >Отправить</button> 
    </form>
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        var $textarea = $('#textarea');
        var $emailinput=$('#emailinput')
        //Валидация textarea
        $textarea.on('input', function() {
            if(valid()){
                $('#valid').empty();
            }else{
                document.getElementById('valid').innerHTML="Некоректно введенные данные";
            }
            
        });
        //Валидация email
        function validateEmail(email) {
        var re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
        return re.test(String(email).toLowerCase());
        }

        $emailinput.on('input', function() {
            if(validemail()){
                emailinput.style.borderColor = 'green';
            }else{
                emailinput.style.borderColor = 'red';
            }
            
        });

        function code(){
            document.getElementById('textarea').value +="<code> </code>";
        }
        function italic(){
            document.getElementById('textarea').value +="<i> </i>";
        }
        function strike(){
            document.getElementById('textarea').value +="<strike> </strike>";
        }
        function strong(){
            document.getElementById('textarea').value +="<strong> </strong>";
        }
        function isValid(s) {
            s = s.replace(/\s/g, '');
            s = s.replace(/[a-zа-яё]/gi, '');
            let open=0;
            let close=0;
            for (let i = 0; i < s.length; i++) {
                if(s[i]=="<"){
                    open++;
                }
                if(s[i]==">"){
                    close++;
                }
            } 
            return open%2==0 && open==close;
        }
        function valid(){
            let string=document.getElementById('textarea').value;
            return isValid(string);
        }
        function validemail(){
            let string=document.getElementById('emailinput').value;
            return validateEmail(string);
        }
    </script>



    </body>
</html>