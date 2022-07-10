<!DOCTYPE html>
<html lang="en">
<head>
    
     <!-- Made with ❤ by Juanelo53 -->
      <!-- Hecho con ❤ por Juanelo53 -->
    
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- SWEET ALERT -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--CONEKTA JS CSS Y MAS-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <title>Bot Payment Telegram</title>
</head>
<body>
    <main class="contenedor">
        <div class="titulo">
            <h1>Pago bot telegram</h1>
        </div>
           <div class="formulario-conekta">
                <form id="card-form" class="formulario">
                    <label>Token Conekta</label>
                     <input type="text" name="conektaTokenId" id="conektaTokenId" value="" placeholder="Aqui estara tu Token">

                          <label>Nombre:</label>
                          <input class="inputs" type="text" data-conekta="card[name]" name="name" id="name" placeholder="Tu nombre" required>

                          <label>Numero de Tarjeta</label>
                          <input class="inputs"  type="number" data-conekta="card[number]" name="card" id="card" placeholder="4242424242424242" maxlength="16" required>

                          <label>Fecha de expiracion</label>
                          <b><!--<input style="width:50px; display:inline-block" value="" data-conekta="card[exp_month]" class="form-control"  type="text" maxlength="2" placeholder="Mes" required>-->
					<select class="inputs"  style="width:82px; display:inline-block" class="form-control" data-conekta="card[exp_month]" autocomplete="off" required>
						<option value="">Mes</option>
						<option value="01">01</option>
						<option value="02">02</option>
						<option value="03">03</option>
						<option value="04">04</option>
						<option value="05">05</option>
						<option value="06">06</option>
						<option value="07">07</option>
						<option value="08">08</option>
						<option value="09">09</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
					</select>
					/
					<!--<input style="width:50px; display:inline-block" value="" data-conekta="card[exp_year]" class="form-control"  type="text" maxlength="2" placeholder="A単o">-->
					<select class="inputs"  style="width:82px; display:inline-block" class="form-control" data-conekta="card[exp_year]" autocomplete="off" required>
						<option value="">A単o</option>
						<option value="22">2022</option>
						<option value="23">2023</option>
						<option value="24">2024</option>
						<option value="25">2025</option>
						<option value="26">2026</option>
						<option value="27">2027</option>
						<option value="28">2028</option>
						<option value="29">2029</option>
						<option value="30">2030</option>
						<option value="31">2031</option>
						<option value="32">2032</option>
						<option value="33">2033</option>
						<option value="34">2034</option>
						<option value="35">2035</option>
						<option value="36">2036</option>
						<option value="37">2037</option>
						<option value="38">2038</option>
						<option value="39">2039</option>
						<option value="40">2040</option>
					</select>
                 </b>

                  <label>Codigo de seguridad</label>
                  <input class="inputs"  type="number" data-conekta="card[cvc]" placeholder="111" maxlength="4" required>

                  <label>Correo Electronico</label>
                  <input class="inputs"  type="email" class="form-control" name="email" id="email" placeholder="email@example.com" required>

                  <label>Concepto</label>
                  <input class="inputs"  type="text" placeholder="PAGO" name="description" id="description" maxlength="100" required>

                  <label>Monto:</label>
                  <input class="inputs"  type="number" name="total" id="total" placeholder="Monto a pagar" required>

                  <input class="boton" type="submit" value="Pagar">
                </form>
               
           </div>
    </main>

    <!-- Empezar tokentizacion con Conekta pa la tarjeta -->
    <script>
          Conekta.setPublicKey("#######"); /* API KEY PUBLICA CONEKTA PARA LLEVAR LOS DATOS*/
        
        var conektaSuccessResponseHandler= function(token){
           
            $("#conektaTokenId").val(token.id);
           
            jsPay();
        };

        var conektaErrorResponseHandler =function(response){
            var $form=$("#card-form");
			Swal.fire({
  icon: 'error',
  title: (response.message_to_purchaser),
  text: 'Oh no! Corrigue los detalles',
  confirmButtonText: 'Volver',
})
		}

        $(document).ready(function(){

            $("#card-form").submit(function(e){
                e.preventDefault();
                
                var $form=$("#card-form");

                Conekta.Token.create($form,conektaSuccessResponseHandler,conektaErrorResponseHandler);
            })
            
        })

        function jsPay(){
            let params=$("#card-form").serialize();
            let url="pay.php"; /*LLEVAR LOS DATOS A CONEKTA*/
            
            $.post(url,params,function(data){
             if(data=="Pago Exitoso"){ //dato 1 = Pago exitoso retornado en pay.php 
                Swal.fire({
  icon: 'success',
  title: 'Exito!!',
  text: 'Tu pago se aprobo con exito!',
  confirmButtonText: 'Volver',
})
                    jsClean();
                }else{
                    Swal.fire({
  icon: 'error',
  title: (data),
  text: 'Oh no! Corrigue los detalles',
  confirmButtonText: 'Volver',
});
                }
            
            })

        }

        function jsClean(){
            $(".form-control").prop("value","");
            $("#conektaTokenId").prop("value","");
        }

    </script>
</body>
</html>