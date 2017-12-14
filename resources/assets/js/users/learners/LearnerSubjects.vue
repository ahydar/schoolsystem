<template>
  <div>
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">{{header}}</h4>

        </div>
    </div>
      <div class="row">
          <div class="col-md-12">
            <notifications />
            <form class="form-horizontal"  @submit.prevent="save" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)">
            </form>
            <div class="panel panel-default">
              <div class="panel-heading">
                <button class="btn btn-primary">
                     Add subjects
                </button>
              </div>
              <div class="panel-body">
                  <table  width="100%" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Subject</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="sub in subjects">
                          <td>
                              {{sub.subjectName}}
                          </td>
                          <td><button class="btn btn-danger btn-xs">Delete</button></td>
                        </tr>
                      </tbody>
                  </table>
              </div>
            </div>
            <modal :modalID="modalID">
                <div slot="header"><h3>Confirm</h3></div>
                <div slot="body">
                </div>
                <div slot="footer">
                    <button type="button" class="btn btn-primary">Yes</button>
                    <button type="button"  class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </modal>
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
        modalID:'learnerSubjects',
        form_id:0,
        id:0,
        header:'Subjects for',
        allSubjects:[],
        subjects:[],
        learnersubjects:[],
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
        if(this.learner){
            this.id = this.learner.id;
            this.form_id = this.learner.form_id;
            this.header = 'Subjects for '+ this.learner.firstName+' '+this.learner.lastName;
            axios.get('learnersubjects/'+this.id+'/'+this.form_id).then(function(result){
                console.log("This learner");
                console.log(result);
                self.learnersubjects = result.data.user.learner.learnersubjects;
                self.allSubjects = result.data.subjects;
                //id in subjects = formsubject_id
                self.subjectList();
            });
        }
    },
    methods:{
        subjectList:function(){
            
        }
    }
  }
</script>
