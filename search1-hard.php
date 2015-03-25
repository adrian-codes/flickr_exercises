<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Flickr Search</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<style>
		#search-form {
			width: 300px;
		}
	</style>
	<script>
        var key = 'https://api.flickr.com/services/rest?&api_key=d21e5d3b7fc02304be47844136741e55&format=json&nojsoncallback=1';
        $('document').ready(function(){
            $('#search-btn').click(function(){
                var userinput = $('#search').val();
                var search = key + '&method=flickr.photos.search&text=' + userinput;
                var photos = [];
                
                $('#photo-list').text("Loading...");
                
                $.ajax({
                    url: search,
                    dataType: 'json',
                    crossDomain: true,
                    success: function(response){
                        photos = response.photos.photo;
                        //displayPhotos(photos);
                        getPhotoInfo(photos);
                        //$('#photo-list').text(photos);
                    },
                    error: function(response){
                        console.log(response.error);   
                    }  
                });
            });
            
            function displayPhotos(photos){
               if(photos.length > 0){
                       $('#photo-list').text('');
               } else{
                console.log('No photos to display');   
               }
                console.log(photos);
                for(var i in photos){
                    var arrayobject = photos[i]; 
                    var url = 'https://farm'+arrayobject.farm+'.staticflickr.com/'+arrayobject.server+'/'+arrayobject.id+'_'+arrayobject.secret+'.jpg';
                    var img = $('<img>').attr('src',url).width(100);
                    $('#photo-list').append(img);
                }
            }
            var photo_info_url = key + '&method=flickr.photos.getInfo';
            
            function getPhotoInfo(photos){
                if(photos.length == 0) {
                    return;
                }
                else{
                  for(var i in photos){
                       var arrayobject = photos[i]; 
                      
                       var get_info_url = photo_info_url+'&photo_id='+arrayobject.id+'&secret='+arrayobject.secret; 
                      console.log("get info url: " +get_info_url);
                  }//end of for
                }//end of else
            } //end of function

            

//start an ajax call
//url key with value of our get_info_url
//our ajax call should expect json back as its datatype
//allow crossdomain requests
//define a success function, with the variable 'response' holding our returned data
//build a url, photo_url, for the photo based on this photo's information.
//make a new image, and add the photo_url to its source.  make its width 100px
//end of our success function call
//define an error function
//report the error to our user
//end of error function call

//end of our ajax call
//end of for loop
            
        });

	</script>

</head>

<body>
	<div id="search-form">
		<div class="panel panel-default panel-primary">
			<div class="panel-heading">Search Flickr</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon glyphicon glyphicon-search"></span>
						<input id="search" type="text" class="form-control" placeholder="Search" name="search" />
					</div>
				</div>
				<button id="search-btn" class="btn btn-lrg btn-default pull-right">Search</button>
			</div>
		</div>
	</div>
	<div id="photo-list">
	</div>
</body>

</html>