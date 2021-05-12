<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Practices</title>
        <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <div class="container py-5">
     
            <a href="{{ route('photos.build') }}" class="btn btn-info">create photo</a>
            <div class="row justify-content-center card">
                <div class="card-body">
                    <form action="{{ route('upload_file') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="file" id="file" class="form-control" value="{{ old('file') }}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Upload</button>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped" id="progress" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        let d = document;
        let form = d.querySelector('form');
        form.addEventListener('submit', function(e){
            e.preventDefault();

            let 
            progress= d.getElementById('progress'),
            file    = d.getElementById('file').files[0],
            size    = file.size,
            name    = file.name,
            format  = name.split('.').pop(),
            action  = this.getAttribute('action'),
            loaded  = 0,
            total   = 0,
            formData= new FormData();
            formData.append('file',file);


            // 1st way 
            // let config = {
            //     headers :{'content-type':'multipart/form-data'},
            //     onUploadProgress :function(progressEvent){
                    // loaded  = progressEvent.loaded;
                    // total   = progressEvent.total;
                    // progress.style.width    = Math.round((loaded*100)/total)+"%";
                    // progress.innerText      = Math.round((loaded*100)/total)+"%";
            //     }
            // };

            // axios.post(action,formData,config)
            // .then(res =>{
            //     if(res.status ==200){
            //         console.log(res)
            //         d.getElementById('file').value="";

                    // setTimeout(function(){
                    //     resetProgress();
                    // },1000);

            //         return 1;
            //     }

            //     resetProgress()
            // })
            // .catch(err=> {
            //     console.log(err)
            //     resetProgress()
            // })

            // 2nd way 
            axios({
                method  : 'post',
                url     : action,
                data    : formData,
                headers : {'content-type':'multipart/form-data'},
                onUploadProgress: function(progressEvent) {
                    loaded  = progressEvent.loaded;
                    total   = progressEvent.total;
                    progress.style.width    = Math.round((loaded*100)/total)+"%";
                    progress.innerText      = Math.round((loaded*100)/total)+"%";
                }
            })
            .then(res=> {
                console.log(res)
                setTimeout(function(){
                    resetProgress();
                    d.getElementById('file').value="";
                },2000);
            })
            .catch(err=> {
                console.log(err)
                resetProgress();
            });

        })


        function resetProgress()
        {
            progress.style.width    = "0%";
            progress.innerText      = "0%";
        }
    </script>
</html>
