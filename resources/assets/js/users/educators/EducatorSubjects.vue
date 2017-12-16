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
            <div v-if="educator" class="panel panel-default">
              <div class="panel-heading">
                <button class="btn btn-primary" data-toggle="modal" data-target="#educatorSubjects">
                     Add subjects
                </button>
              </div>
              <div class="panel-body">
                  <table  width="100%" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Subject</th>
                          <th>Class</th>
                          <th>Remove</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="sub in subjects" v-if="sub.subjectTeaching">
                          <td>{{sub.subjectName}}</td>
                          <td> {{sub.formName}}</td>
                          <td><button class="btn btn-danger btn-xs" @click="remove()">Remove</button></td>
                        </tr>
                      </tbody>
                  </table>
              </div>
            </div>
            <modal :modalID="modalID" width="75%">
                <div slot="header"><h3>Subjects</h3></div>
                <div slot="body">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" v-model="searchVal" @keyup='filterSubs'>
                            <ul>
                                <li v-for="sub in subjectsListed" v-if="!sub.subjectTeaching">
                                    {{sub.subjectName}} {{sub.formName}}
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            
                        </div>
                    </div>
                </div>
                <div slot="footer">
                    <button type="button" class="btn btn-primary pull-left" @click="save">Save</button>
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
       educator: {
         type: Object,
         required: false // User can accept a userData object on params, or not. It's totally optional.
       }
    },
    data(){
      return {
        modalID:'educatorSubjects',
        user_id:0,
        searchVal:'',
        header:'Subjects for',
        subjects:[],
        educatorsubjects:[]
      }
    },
    mounted(){
        var self = this;
        if(this.educator){
            this.user_id = this.educator.id;
            this.header = 'Subjects for '+ this.educator.firstName+' '+this.educator.lastName;
            axios.get('educatorsubjects/'+this.user_id).then(function(result){
                console.log(result);
                self.subjectList(result);
            });
        }
    },
    computed:{
        subjectsListed: function(){
            var self = this;
            return this.subjects.filter(function(subject){
                return subject.subjectName.includes(self.searchVal) || subject.formName.includes(self.searchVal);
            });
        }
    },
    methods:{
        
        subjectList:function(result){
            var self = this;
            console.log(result.data.subjects);
            this.educatorsubjects = result.data.user.educator.educatorsubjects;
            this.subjects = result.data.subjects;
            this.subjects.forEach(function(subject){
                var formsubject_id = subject.id;
                var check = self.educatorsubjects.some(function(arrVal){
                        return arrVal.formsubject_id === formsubject_id;
                });
                if(check){
                    subject.subjectTeaching = true;
                }else{
                    subject.subjectTeaching = false;
                    subject.subjectSelected = false;
                    subject.subjectInList = true;
                }
                
            });
        },
        filterSubs:function(event){
            console.log(event.keyCode);
            console.log(this.searchVal);
            var searchVal = this.searchVal;
            this.subjects.forEach(function(subject){
                console.log("----Busy----");
                if(!searchVal){
                    subject.subjectInList = true;
                }else{
                    if(subject.subjectName.includes(searchVal) || subject.formName.includes(searchVal)){
                    subject.subjectInList = true;
                    }else{
                        subject.subjectInList = false;
                    }
                }
            });
            console.log("/****************************/");
        },
        save:function(){

        },
        remove:function(learnersubject_id){

        }
    }
  }
</script>
