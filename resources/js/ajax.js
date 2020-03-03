//Autocomplete ajax for searching borrower name in librarian.transactions.create
$(document).ready(function(){
    $('#borrower_name').keyup(function(){ 
        var query = $(this).val();
        if(query != ''){
            var _token = $('input[name="_token"]').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({ 
                url:"create/fetchPatron",
                method:"POST",
                data:{query:query, _token:_token},
                dataType: "json",
                success:function(data){
                    $('#patronList').fadeIn();  
                    $('#patronList').html(data);
                }
            });
        }
    })
});
    
$(document).on('click', '#patronList li', function(){  
    $('#borrower_name').val($(this).text());  
    $('#patronList').fadeOut();  
});

//Autocomplete ajax for searching book to be borrowed in librarian.transactions.create
$(document).ready(function(){
    $('#book').keyup(function(){ 
        var query = $(this).val();
        if(query != ''){
            var _token = $('input[name="_token"]').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({ 
                url:"create/fetchBook",
                method:"POST",
                data:{query:query, _token:_token},
                dataType: "json",
                success:function(data){
                    $('#bookList').fadeIn();  
                    $('#bookList').html(data);
                }
            });
        }
    })
});
    
$(document).on('click', '#bookList li', function(){  
    $('#book').val($(this).text());  
    $('#bookList').fadeOut();  
});

//Autocomplete ajax for searching borrower name in librarian.transactions.edit
$(document).ready(function(){
    $('#borrower_name').keyup(function(){ 
        var query = $(this).val();
        if(query != ''){
            var _token = $('input[name="_token"]').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({ 
                url:"edit/fetchPatron",
                method:"POST",
                data:{query:query, _token:_token},
                dataType: "json",
                success:function(data){
                    $('#patronList').fadeIn();  
                    $('#patronList').html(data);
                }
            });
        }
    })
});

$(document).on('click', '#patronList li', function(){  
    $('#borrower_name').val($(this).text());  
    $('#patronList').fadeOut();  
});

//Autocomplete ajax for searching book to be borrowed in librarian.transactions.create
$(document).ready(function(){
    $('#book').keyup(function(){ 
        var query = $(this).val();
        if(query != ''){
            var _token = $('input[name="_token"]').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({ 
                url:"edit/fetchBook",
                method:"POST",
                data:{query:query, _token:_token},
                dataType: "json",
                success:function(data){
                    $('#bookList').fadeIn();  
                    $('#bookList').html(data);
                }
            });
        }
    })
});
    
$(document).on('click', '#bookList li', function(){  
    $('#book').val($(this).text());  
    $('#bookList').fadeOut();  
});