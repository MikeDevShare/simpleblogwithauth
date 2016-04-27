(function($){
    $(document).ready(function(){
       
        $('.nav li a.rel').click(function(e){
            e.preventDefault();                
            $('#'+$(this).attr('rel')).fadeIn('slow');
        });
        $('.overlay').click(function(e){
            $('.modal').fadeOut('slow');
        });
        $('.cat-list a').click(function(e){
            e.preventDefault();
            if( $(this).attr('href') == '#edit' ){
                var cat_id = $(this).attr('rel');
                var URL = $('#base-url').val()+'/dashboard/get-cat';
                var token = $(this).parent().find('input').val();
                $('form.edit-cat input[name=cat_id]').val(cat_id);
                $.ajax({
                    url: URL,
                    type: "POST",
                    cache: false,
                    data:{
                        'cat_id' : cat_id,
                        '_token' : token
                    },
                    dataType: 'json',
                    error:function(xhr, status, errorThrown) {
                        alert(errorThrown+'\n'+status+'\n'+xhr.statusText);
                        $('.preloader').hide();
                    },
                    success:function(data)
                    {
                        if( data.success ){
                            $('form.edit-cat input[name=title]').val(data.title);
                            $('form.edit-cat textarea[name=body]').val(data.body);
                            $('form.edit-cat').show().removeClass('hidden');
                        }else{
                            $('.message').html(data.error);
                        }
                        
                    }
                });
            }else{
                var cat_id = $(this).attr('rel');
                var URL = $('#base-url').val()+'/dashboard/delete-cat';
                var token = $(this).parent().find('input').val();
                $.ajax({
                    url: URL,
                    type: "POST",
                    cache: false,
                    data:{
                        'cat_id' : cat_id,
                        '_token' : token
                    },
                   
                    error:function(xhr, status, errorThrown) {
                        alert(errorThrown+'\n'+status+'\n'+xhr.statusText);
                        $('.preloader').hide();
                    },
                    success:function(data)
                    {
                        window.location.reload();
                    }
                });
            }
            
            
        });
        $('.edit-cat input[type=submit]').click(function(e){
            e.preventDefault(); 
            var URL = $('#base-url').val()+'/dashboard/edit-cat';    
            var token = $(this).parent().find('input').val();      
            $.ajax({
                url: URL,
                type: "POST",
                cache: false,
                data:{
                    'cat_id' : $(this).parent().find('input[name=cat_id]').val(),
                    'title'  : $(this).parent().find('input[name=title]').val(),
                    'body'   : $(this).parent().find('textarea[name=body]').val(),
                    '_token' : token
                },
                dataType: 'json',
                error:function(xhr, status, errorThrown) {
                    alert(errorThrown+'\n'+status+'\n'+xhr.statusText);
                    $('.preloader').hide();
                },
                success:function(data)
                {
                    $('.message').html(data.message);
                   
                }
            });
        });
    });
})(jQuery);