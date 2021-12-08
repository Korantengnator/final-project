<!-- not done -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Chatbot</title>
    <link rel="stylesheet" href="botstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="chatroom">
        <div class="title">My Study Guide
            
        </div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="msg">
                    <p>Welcome to MyStudyGuide, type in help to see FAQs?</p>
                </div>
            </div>
           
        </div>
        <div class="typingField">
            <div class="input-data">
                <input id="text" type="text" placeholder="Say something.." required>
                <button id="send">Send</button>
            </div>
        </div>
    </div>
    <span>
    <form action="get">
               <button onclick="goToHome()"  style="font-size: 16px; border-radius: 5px; border: none;  background: rgb(233, 80, 80); width: 60px; color: #fff; outline: none; " name="back">Home</button>
            </form>
    </span>
    
    <script>
        $(document).ready(function(){
            $("#send").on("click", function(){
                $value = $("#text").val();
                 $message = '<div class="user-inbox inbox"><div class="msg"><p>'+ $value +'</p></div></div>';
                 $(".form").append($message);
                 $("#text").val('');
                
                // start ajax code
                 $.ajax({
                     url: 'connection.php',
                     type: 'POST',
                     data: 'text='+$value,
                     success: function(result){
                         $reply = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg"><p>'+ result +'</p></div></div>';
                         $(".form").append($reply);
                         // when chat goes down the scroll bar automatically comes to the bottom
                         $(".form").scrollTop($(".form")[0].scrollHeight);
                     }
                 });
            });
        });
    </script> 

    <script>
        function goToHome(){
            window.open('../index.php');
        }
    </script>
    
</body>
</html>