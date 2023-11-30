@extends('layouts.app')


<style>
    body{
        background-image: linear-gradient(#e4e4e4, #b5d8f5);
    }
</style>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


@section('content')
<section class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <h1 class="text-center text-success">Add Customer</h1>

        {{-- <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div> --}}
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" id="names" name="name">
            <span class="error text-danger" id="name-error"></span>
        </div>
        <div class="form-group">
            <label for="name">Age</label>
            <input type="number" class="form-control" id="ages" name="age">
            <span class="error text-danger" id="age-error"></span>
        </div>
        <div class="form-group">
            <label for="name">Email</label>
            <input type="email" class="form-control" id="emails" name="email">
            <span class="error text-danger" id="email-error"></span>
        </div>
        <div class="form-group">
            <label for="name">Phone</label>
            <input type="number" class="form-control" id="phones" name="phone">
            <span class="error text-danger" id="phone-error"></span>
        </div>

        <button type="submit" onclick="customer()" class="btn btn-success mt-3">Submit</button>
        <a href="/" class="btn btn-secondary mt-3">Go Back Home</a>

    </div>
    <div class="col-lg-2"></div>
</section>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">

    function customer()
    {

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

        var name = $("input[name=name]").val();
        // if (!name) {
        //     $('#name-error').text('The name field is required.');
        //     return;
        // }
        var age = $("input[name=age]").val();
        var email = $("input[name=email]").val();
        var phone = $("input[name=phone]").val();

        $.ajax({
            type:'POST',
            url:"{{ route('customer.create') }}",
            data:{name:name, age:age, email:email, phone:phone},
            success:function(response) {

                if(response.success) {
                    alert(response.success);
                    window.location.href = '/';
                }

                 if(response.errors.name) {
                    $('#name-error').text(response.errors.name);
                 }
                 if(response.errors.email){
                    $('#email-error').text(response.errors.email);
                }
                if(response.errors.age) {
                    $('#age-error').text(response.errors.email);
                }
                if(response.errors.phone) {
                    $('#phone-error').text(response.errors.email);
                }

            }
        });
    }
</script>
@endsection
