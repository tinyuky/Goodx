
  <template>
    <div class="">
      <header>
            <div class="collapse bg-white" id="navbarHeader">
              <div class="container">
                <div class="row">
                  <div class="col-sm-8 col-md-7 py-4" v-for="(user,index) in users">
                    <hr class="mb-12">
                    <h4 class="mb-12"
                          v-bind:style=" user.id == you.id ?'color:red':''">
                      #{{index+1}} - {{user.name}} - {{user.score}} score
                    </h4>
                    <hr class="mb-4">
                  </div>
                </div>
              </div>
            </div>
            <div class="navbar navbar-dark bg-dark box-shadow">
              <div class="container d-flex justify-content-between">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              </div>
            </div>
          </header>

            <br>
              <div class="container text-center">
                <h1 class="jumbotron-heading">THANKS FOR USING OUR QUIZ</h1>
                <p class="lead text-muted">See you next time</p>
                <p class="lead text-muted">You can see your result with another people in the menu</p>
              </div>
    </div>
  </template>
  <script>
    export default{
      data: function(){
          return {
            users:[],
            you:[]
          }
      },
      mounted(){
        var app = this;
        //get user from api
        axios.post('/api/getuser')
            .then(function (resp) {
                app.users = resp.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Could not load user");
            });
        // get newest user from api
        axios.post('/api/getnewuser')
              .then(function (resp){
                app.you = resp.data;
              })
              .catch(function (resp) {
                  console.log(resp);
                  alert("Could load new user");
              });

      }
    }
  </script>
