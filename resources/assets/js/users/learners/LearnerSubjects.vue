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
                <button class="btn btn-primary" data-toggle="modal" data-target="#learnerSubjects">
                     Add subjects
                </button>
              </div>
              <div class="panel-body">
                  <table  width="100%" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Subject</th>
                          <th>Remove</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="sub in subjectsTaken">
                          <td>
                              {{sub.subjectName}}
                          </td>
                          <td><button class="btn btn-danger btn-xs" @click="remove(sub.learnersubject_id)">Remove</button></td>
                        </tr>
                      </tbody>
                  </table>
              </div>
            </div>
            <modal :modalID="modalID">
                <div slot="header"><h3>Confirm</h3></div>
                <div slot="body">
                    <div class="checkbox input-sm" v-for="sub in subjectsNotTaken">
                        <label><input type="checkbox" v-model="sub.checked">{{sub.subjectName}}</label>
                    </div>
                </div>
                <div slot="footer">
                    <button type="button" class="btn btn-primary pull-left" @click="save" v-if="subjectsNotTaken.length">Save</button>
                    <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
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
        user_id:0,
        header:'Subjects for',
        allSubjects:[],
        subjectsTaken:[],
        subjectsNotTaken:[],
        learnersubjects:[],
      }
    },
    mounted(){
        var self = this;
        if(this.learner){
            this.user_id = this.learner.id;
            this.form_id = this.learner.form_id;
            this.header = 'Subjects for '+ this.learner.firstName+' '+this.learner.lastName;
            axios.get('learnersubjects/'+this.user_id+'/'+this.form_id).then(function(result){
                console.log(result);
                self.subjectList(result);
            });
        }
    },
    methods:{
        subjectList:function(result){
            console.log(result.data.subjects);
            this.learnersubjects = result.data.user.learner.learnersubjects;
            this.allSubjects = result.data.subjects;
            this.subjectsTaken = [];
            this.subjectsNotTaken = [];
            for(var i=0;i<this.learnersubjects.length;i++){
                for(var j=0;j<this.allSubjects.length;j++){
                    //console.log(this.allSubjects[j]);
                    if(this.learnersubjects[i].formsubject_id === this.allSubjects[j].id){
                        this.allSubjects[j].learnersubject_id = this.learnersubjects[i].id;
                        this.subjectsTaken.push(this.allSubjects[j]);
                        this.allSubjects.splice(j,1);
                    }

                    if(this.allSubjects[j]){
                        this.allSubjects[j].user_id = this.user_id;
                        this.allSubjects[j].checked = false;
                    }
                    
                }
            }
            this.subjectsNotTaken = this.allSubjects;
        },
        save:function(){
            $("#"+this.modalID).modal("hide");
            if(this.subjectsNotTaken.length != 0){
                console.log("Going through");
                console.log(this.subjectsNotTaken);
                var saveSubjects = this.subjectsNotTaken.filter(element => element.checked === true);
                var self = this;
                axios.post('learnersubjects',saveSubjects).then(function(result){
                    console.log(result);
                    self.subjectList(result);
                });
            }
        },
        remove:function(learnersubject_id){
            var self = this;
            console.log(learnersubject_id);
            axios.delete('learnersubjects/'+learnersubject_id+'/'+this.user_id+'/'+this.form_id).then(function(result){
                    console.log(result);
                    self.subjectList(result);
                });
        }
    }
  }
</script>
