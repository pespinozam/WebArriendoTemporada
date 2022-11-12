<?php  include("../admin/config/bdPaypal.php"); 

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id= "paypal-button-container"></div>

<script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID;?>"></script>
<script>
    paypal.Buttons({
        style:{
            color:'blue',
            shape:'pill',
            color:'blue',
            label:'pay'
        },
        createOrder:function(data,actions){
            return actions.order.create({
                purchase_units:[{
                    amount:{
                        value: 100
                    }
                }]
            });

        },
        onApprove:function(data,actions){
            let URL = 'captura.php'
            actions.order.capture().then(function(detalles){
                console.log(detalles)
                let URL= 'captura.php'
                return fetch(url,{
                    method:'post',
                    headers:{
                        'content-type': 'application/json'
                    },
                    body: JSON.stringfy({
                        detalles: detalles
                    })
                })

            });

        },

        onCancel:function(data){
            alert("Pago Cancelado");
            console.loge(data);
        }
    }).render('#paypal-button-container');
</script>
</body>
    <form method="POST" action="">
        <input type="checkbox" name=""c1>si
        <input type="checkbox" name=""c2>no
    </form>
</html>