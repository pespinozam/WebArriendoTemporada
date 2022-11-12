<?php  include("../admin/config/bdPaypal.php"); ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID;?>"></script>
    <title>Document</title>
</head>
<body>
    <div id= "paypal-button-conteiner"></div>
        <script>
            paypal.Buttons({
                style:{
                    color:'blue',
                    shape:'pill',
                    label:'pay'
                },
                createOrder:function(data,actions){
                    return actions.order.create({
                        purchase_units:[{
                            amount:{
                                value: '1'
                            },

                        }]
                    });

                },
                onApprove:function(data,actions){
                    actions.order.capture().then(function(detalles){
                        window.location.href="completado.php";

                    });

                },

                onCancel:function(data){
                    alert("Pago Cancelado");
                    console.loge(data);
                }
            }).render('#paypal-button-container');
        </script>
</body>
</html>

