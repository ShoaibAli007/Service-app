<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Bootstrap Theme Company Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  .jumbotron {
    background-color: #f4511e;
    color: #fff;
    padding: 100px 25px;
  }
  .container-fluid {
    padding: 60px 50px;
  }
  .bg-grey {
    background-color: #f6f6f6;
  }
  .logo-small {
    color: #f4511e;
    font-size: 50px;
  }
  .logo {
    color: #f4511e;
    font-size: 200px;
  }
  .thumbnail {
    padding: 0 0 15px 0;
    border: none;
    border-radius: 0;
  }
  .thumbnail img {
    width: 100%;
    height: 100%;
    margin-bottom: 10px;
  }
  .carousel-control.right, .carousel-control.left {
    background-image: none;
    color: #f4511e;
  }
  .carousel-indicators li {
    border-color: #f4511e;
  }
  .carousel-indicators li.active {
    background-color: #f4511e;
  }
  .item h4 {
    font-size: 19px;
    line-height: 1.375em;
    font-weight: 400;
    font-style: italic;
    margin: 70px 0;
  }
  .item span {
    font-style: normal;
  }
  .panel {
    border: 1px solid #f4511e; 
    border-radius:0 !important;
    transition: box-shadow 0.5s;
  }
  .panel:hover {
    box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
    border: 1px solid #f4511e;
    background-color: #fff !important;
    color: #f4511e;
  }
  .panel-heading {
    color: #fff !important;
    background-color: #f4511e !important;
    padding: 25px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
  }
  .panel-footer {
    background-color: white !important;
  }
  .panel-footer h3 {
    font-size: 32px;
  }
  .panel-footer h4 {
    color: #aaa;
    font-size: 14px;
  }
  .panel-footer .btn {
    margin: 15px 0;
    background-color: #f4511e;
    color: #fff;
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
  }
  </style>
</head>
<body>

<div class="jumbotron text-center">
  <h1>Company</h1> 
  <p>We specialize in providing services</p> 
  <form class="form-inline">
    <div class="input-group">
      <input type="email" class="form-control" size="50" placeholder="Email Address" required>
      <div class="input-group-btn">
        <button type="button" class="btn btn-danger">Subscribe</button>
      </div>
    </div>
  </form>
</div>


<!-- Container (Pricing Section) -->
<div class="container-fluid">
  <div class="text-center">
    <h2>Service</h2>
    <h4>Choose a service best for you!</h4>
  </div>
  <div class="row">
  @foreach($services as $service)
      <div class="col-sm-4 col-xs-12">
        <div class="panel panel-default text-center">
          <div class="panel-heading">
            <h1>{{ $service['name'] }}</h1>
          </div>
          <div class="panel-body">
              <p><strong>{{ $service->detail }}</strong></p>
          </div>
          <div class="panel-footer">
            <h3>${{ $service['price'] }}</h3>
            <button class="btn btn-lg" data-id="{{$service->id}}">Purchase Service</button>
          </div>
        </div>
      </div>
    @endforeach  
  </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Purchase Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="payment-form" method="post" action="{{ route('purchase.service') }}">
            @csrf
            <div class="form-group">
                <!-- <label for="project-id">Project ID</label> -->
                <input type="hidden" class="form-control" id="service-id" name="service_id" required>
            </div>
            <div class="form-group">
                <label for="cardholder-name">Cardholder Name</label>
                <input type="text" class="form-control" id="cardholder-name" name="cardholder_name" required>
            </div>
            <div class="form-group" id="card-element">
                <!-- Include the Card Element here -->
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Pay Now</button>
            </div>
        </form>
                </div>
               
            </div>
        </div>
    </div>
<!-- Footer section -->
<footer class="bg-dark text-white text-center py-3">
    <p>&copy; <?php echo date("Y"); ?> Your Company. All rights reserved.</p>
</footer>

</body>
<script>
  // Your custom JavaScript code goes here
  $(document).ready(function() {
    // Example: Alert when the "Sign Up" button is clicked
    $('.btn-lg').on('click', function() {
        let service_id = $(this).attr('data-id');
      $('#service-id').val(service_id);
      $('#exampleModal').modal('show');
    });
  });
</script>

    <!-- Include the Braintree JavaScript SDK -->
    <script src="https://js.braintreegateway.com/web/dropin/1.31.2/js/dropin.min.js"></script>
    <script>
          $(document).ready(function() {

        // Initialize the Drop-in UI
        var form = document.getElementById('payment-form');
        var client_token = "{{ $token }}";

        var myContainer = document.getElementById('card-element');

        myContainer.innerHTML = '';
        braintree.dropin.create({
            authorization: client_token,
            container: '#card-element'
        }, function (createErr, instance) {
            if (createErr) {
                console.error(createErr);
                return;
            }
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                instance.requestPaymentMethod(function (err, payload) {
                    if (err) {
                        console.error(err);
                        return;
                    }

                    // Add the payment_method_nonce to the form and submit
                    var nonce = document.createElement('input');
                    nonce.setAttribute('type', 'hidden');
                    nonce.setAttribute('name', 'payment_method_nonce');
                    nonce.setAttribute('value', payload.nonce);
                    form.appendChild(nonce);

                    form.submit();
                });
            });
        });

    });
    </script>

</html>
