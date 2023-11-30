@extends('layouts.app')

<style>
    body{
        background-image: linear-gradient(#e4e4e4, #b5d8f5);
    }
    th, td{
        padding: 15px 5px !important;
    }
</style>


@section('content')

<section class="row">


    <!-- Customer-Edit Modal Starts -->
    <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-success" id="exampleModalLabel">Edit Customer</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="u_name">Full Name</label>
                    <input type="text" class="form-control" id="u_names" name="u_name">
                    <input type="hidden" class="form-control" id="cs_id" name="c_id">
                    <span class="error text-danger" id="name-error"></span>
                </div>
                <div class="form-group">
                    <label for="u_age">Age</label>
                    <input type="number" class="form-control" id="u_ages" name="u_age">
                    <span class="error text-danger" id="age-error"></span>
                </div>
                <div class="form-group">
                    <label for="u_email">Email</label>
                    <input type="email" class="form-control" id="u_emails" name="u_email">
                    <span class="error text-danger" id="email-error"></span>
                </div>
                <div class="form-group">
                    <label for="u_phone">Phone</label>
                    <input type="number" class="form-control" id="u_phones" name="u_phone">
                    <span class="error text-danger" id="phone-error"></span>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="submit" onclick="update_cust()" class="btn btn-success">Update</button>
            </div>
          </div>
        </div>
    </div>
    <!-- Customer-Edit Modal Ends -->

    <!-- Transaction Modal Starts -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-success" id="exampleModalLabel">Add Transaction</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="postForm">
                <div class="form-group">
                    <label for="invoice">Invoice No</label>
                    <input type="number" class="form-control" id="invoices" name="invoice">
                    <span class="error text-danger" id="invoice-error"></span>
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control" id="amounts" name="amount">
                    <span class="error text-danger" id="amount-error"></span>
                </div>
                <button type="submit" class="btn btn-success" id="submitPost">Submit</button>
            </div>


          </div>
        </div>
      </div>
      <!-- Transaction Modal Ends -->

    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <h1 class="text-success text-center mt-2">List of All Customers</h1>
        <a href="{{ route('customer.add') }}" class="btn btn-success mt-2 float-end text-light">Add <i class="las la-plus"></i></a>
        <table class="table table-hover" style="border-style:solid; border-color: black;">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Full Name</th>
                <th scope="col">Age</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody class="data1" id="item-list">
                {{-- @foreach ($customers as $customer)
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $customer->name }}</td>
                </tr>
            @endforeach --}}
            </tbody>
        </table>
    </div>
    <div class="col-lg-2"></div>
</section>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<!-- Show Customer -->
<script type="text/javascript">

    $(document).ready(function ()
    {
        $.ajax({
            type:'get',
            url:"{{ route('customer.show') }}",
            dataType: 'json',
            success: function (response) {
                var customers = response.customers;

                customers.forEach(function (customer) {
                    $('#item-list').append('<tr>' +
                                                '<th>' + customer.id + '</th>' +
                                                '<td>' + customer.full_name + '</td>' +
                                                '<td>' + customer.age + '</td>' +
                                                '<td>' + customer.email + '</td>' +
                                                '<td>' + customer.phone + '</td>' +
                                                '<td>' +
                                                    '<button type="button" class="btn btn-success avi" data-bs-toggle="modal" data-bs-target="#exampleModalEdit" onclick="edit_cust('+customer.id+')">' + '<i class="las la-pen">' + '</i>' + '</button>' +
                                                    '<button class="btn btn-danger deletes" onclick="deletei('+customer.id+')">' + '<i class="las la-trash">' + '</i>' + '</button>' +
                                                    '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="transactions('+customer.id+')">' + '<i class="las la-money-bill-wave">' + '</i>' + '</button>' +
                                                '</td>' +
                                            '</tr>');
                });
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
</script>


<!-- Edit Customer -->
<script type="text/javascript">

    var id = 0;
    function edit_cust(id) {
        // alert(id);
        $.ajax({
            type: 'get',
            url: '/customer/edit/' + id,
            success:function (data) {
                $('#cs_id').val(data.customers.id);
                $('#u_names').val(data.customers.full_name);
                $('#u_ages').val(data.customers.age);
                $('#u_emails').val(data.customers.email);
                $('#u_phones').val(data.customers.phone);
            },
            error: function (error) {
                console.log(error);
            }
        });

    }

</script>
<!-- Edit Customer -->


<!-- Update Customer -->
<script type="text/javascript">

function update_cust() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var id = $("input[id=cs_id]").val();
    //  alert(id);
    var name = $("input[name=u_name]").val();

    var age = $("input[name=u_age]").val();
    var email = $("input[name=u_email]").val();
    var phone = $("input[name=u_phone]").val();
    //  alert(name);

    $.ajax({
        type: 'POST',
        url: "{{ route('customer.update') }}",
        data: {name:name, age:age, email:email, phone:phone, id:id},
        success:function (response) {
            $('#exampleModalEdit').hide();
            if(response.success) {
                alert(response.success);
                window.location.href = '/';
            }
        }
    });

}

</script>
<!-- Update Customer -->


<!-- Delete Customer -->
<script type="text/javascript">
    var id = 0;
    function deletei(id){
        //alert(id);
        var confirmation = confirm("Are you sure you want to remove this customer?");

        if(confirmation){

            $.ajax({
                url: '/customer/delete/' + id,
                type: 'get',
                dataType: 'json',
                // data: {"id": id},
                success: function (response) {
                    alert(response.success);
                    window.location.href = '/';
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    }
</script>


<!-- Add Transaction-->
<script type="text/javascript">

var id = 0;
function transactions(id)
{
//  alert(id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#submitPost').click(function () {
            var invoice = $("input[name=invoice]").val();
            var amount = $("input[name=amount]").val();
// alert(invoice);
            $.ajax({
                type: 'POST',
                url: '{{ route("transaction.create") }}',
                data: {invoice:invoice, amount:amount, id:id},
                success: function (response) {
                    alert(response.message);
                    $('#exampleModal').modal('hide');
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
}
</script>
@endsection
