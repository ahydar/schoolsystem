<template>
  <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">New Educator</h4>

        </div>
    </div>
      <div class="row">
          <div class="col-md-8">
            <notifications />
            <form class="form-horizontal"  @submit.prevent="save" @keydown="form.errors.clear($event.target.name)">

              <div class="form-group">
                <label class="control-label col-sm-2" for="firstName"><span class="pull-left">First Name:</span></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter Name" v-model="form.firstName">
                  <span style="color:red;" v-text="form.errors.get('firstName')"></span>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="lastName"><span class="pull-left">Surname:</span></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Surname" v-model="form.lastName">
                  <span style="color:red;" v-text="form.errors.get('lastName')"></span>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="email"><span class="pull-left">Email:</span></label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" v-model="form.email">
                  <span style="color:red;" v-text="form.errors.get('email')"></span>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="title"><span class="pull-left">Title:</span></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" v-model="form.title">
                  <span style="color:red;" v-text="form.errors.get('title')"></span>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="initial"><span class="pull-left">Initial:</span></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="initial" name="initial" placeholder="Enter Intitial" v-model="form.initial">
                  <span style="color:red;" v-text="form.errors.get('initial')"></span>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                  <div class="checkbox">
                    <label><input type="checkbox"> Admin</label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                  <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
              </div>
            </form>
          </div>
      </div>
  </div>
</template>
<script>
  import {Form} from '../../services/form';
  import InputField from '../../components/InputField';
  export default {
    components:{'input-field':InputField},
    data(){
      return {
        form: new Form({
            firstName:'',
            lastName:'',
            email:'',
            initial:'',
            title:''
        }),
      }
    },
    methods:{
      save:function(){
        var self = this;
        this.form.submit('post','/educators').then(function(result){
                if(result.exists){
                    alert(result.exists);
                }
                console.log(result);
        });
      }
    }
  }
</script>
