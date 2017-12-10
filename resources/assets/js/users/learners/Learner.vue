<template>
  <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">{{header}}</h4>

        </div>
    </div>
      <div class="row">
          <div class="col-md-8">
            <notifications />
            <form class="form-horizontal"  @submit.prevent="save" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)">

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
                <label class="control-label col-sm-2" for="gender"><span class="pull-left">Gender:</span></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="gender" name="gender" placeholder="e.g Male or Female" v-model="form.gender">
                  <span style="color:red;" v-text="form.errors.get('gender')"></span>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="learnerNumber"><span class="pull-left">Learner Number:</span></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="title" name="learnerNumber" placeholder="Enter learner number" v-model="form.learnerNumber">
                  <span style="color:red;" v-text="form.errors.get('learnerNumber')"></span>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="yearsInPhase"><span class="pull-left">Years in phase:</span></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="initial" name="yearsInPhase" placeholder="Enter years in phase" v-model="form.yearsInPhase">
                  <span style="color:red;" v-text="form.errors.get('yearsInPhase')"></span>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="form_id"><span class="pull-left">Class:</span></label>
                <div class="col-sm-8">
                  <select class="form-control" name='form_id' v-model="form.form_id" title="select a class">
                    <option v-for="form in classes" v-bind:value="form.id">
                      {{ form.formName }}
                    </option>
                  </select>
                  <span style="color:red;" v-text="form.errors.get('form_id')"></span>
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
  export default {
    props:{
       learner: {
         type: Object,
         required: false // User can accept a userData object on params, or not. It's totally optional.
       }
    },
    data(){
      return {
        header:'New Learner',
        classes:[],
        action:'post',
        url:'/learners',
        form: new Form({
            form_id:0,
            firstName:'',
            lastName:'',
            gender:'',
            email:'',
            learnerNumber:'',
            yearsInPhase:''
        }),
      }
    },
    mounted(){
        var self = this;
        axios.get('classes').then(function(result){
            self.classes = result.data.classes;
        });
        console.log('Mounted');
        if(this.learner){
          this.header = 'Edit Learner';
          this.action = 'patch';
          this.url = '/learners/'+this.learner.id;
          this.form.edit(this.learner);
          console.log(this.learner);
        }
    },
    methods:{
      save:function(){
        var self = this;
        this.form.submit(self.action,self.url).then(function(result){
                if(result.exists){
                    alert(result.exists);
                }else{
                    self.$router.push('/learners');
                }
                console.log(result);
        });
      }
    }
  }
</script>
