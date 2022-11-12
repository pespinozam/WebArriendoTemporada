<?php   ?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.paypal.com/sdk/js?client-id=AaVcFvgqJarxVC48uxGMXJPDSDdaIU4s6pIMlgJosv-QZBWPDilltTWQz3y-mRV0LyYu6WiKURChfa4U"></script>
    <title>Document</title>
</head>
<body>
    <div id= "paypal-button-container"></div>

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
                            }
                        }]
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