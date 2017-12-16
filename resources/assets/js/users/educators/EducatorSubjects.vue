<template>
  <div>
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">{{header}}</h4>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div  v-for="sub in educatorsubjects" v-if='!sub.checked'>
                {{sub.name}}  <button class="btn btn-success pull-right btn-xs" @click="sub.checked = !sub.checked">Add</button>
                <br><br>
            </div>
        </div>
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div v-for="sub in educatorsubjects" v-if='sub.checked'>
                {{sub.name}}  <button class="btn btn-danger pull-right btn-xs" @click="sub.checked = !sub.checked">Remove</button>
                <br><br>
            </div>
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
                          <th>Remove</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="sub in subjectsTaken">
                          <td>
                              {{sub.subjectName}}
                          </td>
                          <td><button class="btn btn-danger btn-xs" @click="remove()">Remove</button></td>
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
       educator: {
         type: Object,
         required: false // User can accept a userData object on params, or not. It's totally optional.
       }
    },
    data(){
      return {
        modalID:'educatorSubjects',
        form_id:0,
        user_id:0,
        header:'Subjects for',
        allSubjects:[],
        subjectsTaken:[],
        subjectsNotTaken:[],
        educatorsubjects:[
            {name:"English",checked:false},
            {name:"Math",checked:false},
            {name:"Afrikaans",checked:true},
            {name:"Arabic",checked:false},
            {name:"Fiqh",checked:false}
        ],
      }
    },
    mounted(){
        var self = this;
        if(this.educator){
            this.user_id = this.educator.id;
            this.form_id = this.educator.form_id;
            this.header = 'Subjects for '+ this.educator.firstName+' '+this.educator.lastName;
            axios.get('learnersubjects/'+this.user_id+'/'+this.form_id).then(function(result){
                console.log(result);
                self.subjectList(result);
            });
        }
    },
    methods:{
        subjectList:function(result){

        },
        save:function(){

        },
        remove:function(learnersubject_id){

        }
    }
  }
</script>
