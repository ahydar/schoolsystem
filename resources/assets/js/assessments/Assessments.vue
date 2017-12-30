<template>
  <div>
    <div class="row">
        <div class="col-md-3">
            <subjectslist></subjectslist>
            <div class="panel panel-default">
              <div class="panel-heading">Subjects</div>
              <div class="panel-body">
                   <ul class="list-group">
                      <li class="list-group-item" v-for='sub in subjects'><button class="btn btn-xs" @click="assessments(sub)">{{sub.subjectName}}</button></li>
                    </ul>
              </div>
            </div>

        </div>
        <div class="col-md-9">
          <div class="panel panel-default" v-if="subjectSelected">
              <div class="panel-heading">{{subjectName}} <button class="btn btn-default btn-sm" @click="add()">New Assessment</button></div>
              <div class="panel-body">
                <table class="table table-hover">
                  <thead slot="head">
                    <tr>
                      <th v-for="col in columns">
                        {{col.title}}
                      </th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody slot="body">
                    <tr v-for="item in assess">
                        <td v-for="col in columns">
                            {{item[col.field]}}
                        </td>
                        <td> <button type="button" @click="edit(item)" class="btn btn-primary btn-xs">Edit</button></td>
                        <td> <button type="button" @click="removeCheck(item)" class="btn btn-danger btn-xs">Delete</button></td>
                    </tr>
                  </tbody>
                </table>
                <modal modalID="myModal">
                  <div slot="header">
                    <h4>{{heading}}</h4>
                    <span class="pull-right" v-if="loading">Saving <i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i></span>
                  </div>
                  <div slot="body">
                    <form class="form-horizontal"  @submit.prevent="save" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)">

                      <div class="form-group">
                        <label class="control-label col-sm-2" for="assessName"><span class="pull-left">Name:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="assessName" name="assessName" placeholder="Enter Name" v-model="form.assessName">
                          <span style="color:red;" v-text="form.errors.get('assessName')"></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-2" for="assessTerm"><span class="pull-left">Term:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="assessTerm" name="assessTerm" placeholder="Enter Term" v-model="form.assessTerm">
                          <span style="color:red;" v-text="form.errors.get('assessTerm')"></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-2" for="assessMark"><span class="pull-left">Mark:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="assessMark" name="assessMark" placeholder="Enter Mark" v-model="form.assessMark">
                          <span style="color:red;" v-text="form.errors.get('assessMark')"></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-2" for="assessTermPercentage"><span class="pull-left">Term %:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="assessTermPercentage" name="assessTermPercentage" placeholder="Enter Term %" v-model="form.assessTermPercentage">
                          <span style="color:red;" v-text="form.errors.get('assessTermPercentage')"></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-2" for="assessFinalPercentage"><span class="pull-left">Final %:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="assessFinalPercentage" name="assessFinalPercentage" placeholder="Enter Final %" v-model="form.assessFinalPercentage">
                          <span style="color:red;" v-text="form.errors.get('assessFinalPercentage')"></span>
                        </div>
                      </div>


                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                          <button type="submit" class="btn btn-primary pull-right" >Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </modal>
                <confirm
                message="Are you sure you want to remove this assessment. Note: all learners linked 
                to this assessment will be unlinked."
                :name = "assessName"
                btnClass="danger" v-on:confirmed="remove" :modalID="deleteModalId"></confirm>
              </div>
            </div>
        </div>
    </div>
   </div>   
</template>
<script>
  import {dataTableLoad,destroyDataTable} from '../services/dataTablesService';
  import {Form} from '../services/form';
  import SubjectsList from '../ListComponents/SubjectsList';
  export default {
    components:{'subjectslist':SubjectsList},
    data(){
      return {
        loading:false,
        editing:false,
        subjects:[],
        assess:[],
        tableID:'learners',
        subjectSelected:false,
        subjectName:'',
        assessName:'',
        formsubject_id:'',
        deleteModalId:'delete',
        heading:'',
        index:'',
        assessIndex:'',
        form: new Form({
            formsubject_id:'',
            assessName:'',
            assessTerm:'',
            assessMark:'',
            assessTermPercentage:'',
            assessFinalPercentage:''
        }),
        columns:[
          {title:'Name',field:'assessName'},
          {title:'Term',field:'assessTerm'},
          {title:'Mark',field:'assessMark'},
          {title:'Term %',field:'assessTermPercentage'},
          {title:'Final %',field:'assessFinalPercentage'},
        ]
      }
    },
    created() {
          this.$root.pageHead = "Assessmets";
    },
    mounted(){
        var self = this;
        axios.get('/assessments').then(function(result){
            self.subjects = result.data;
            console.log(result.data);
        });
    },
    methods:{
        assessments:function(sub){
          this.index = this.subjects.indexOf(sub);
          console.log(sub);
          this.subjectName = sub.subjectName;
          this.formsubject_id = sub.formsubject_id;
          this.subjectSelected = true;
          this.assess = sub.assessments;
          console.log(this.assess);
        },
        save:function(){
            var self = this;            
            if(!this.editing){
              this.form.submit('post','/assessments/'+this.formsubject_id).then(function(result){
                      $('#myModal').modal('hide');
                      self.subjects[self.index].assessments.push(result);
              });
            }else{
              this.form.submit('patch','/assessments').then(function(result){
                      $('#myModal').modal('hide');
                      self.subjects[self.index].assessments.splice(self.assessIndex,1,result);
                      console.log(result);
              });
            }
        },
        removeCheck:function(data){
          $("#"+this.deleteModalId).modal('show');
          this.assessIndex = this.assess.indexOf(data);
          this.assessName = data.assessName+" - Term: "+ data.assessTerm;
        },
        remove:function(){
            $("#"+this.deleteModalId).modal('hide');
            
            var id = this.subjects[this.index].assessments[this.assessIndex].id;
            var self = this;
            console.log("We'll take it from here -- "+id);
            axios.delete('/assessments/'+id).then(function(result){
               self.subjects[self.index].assessments.splice(self.assessIndex,1);
            });
            
        },
        add:function(){
          this.form.reset();
          this.heading = "New Assessment - "+this.subjectName;
          this.editing = false;
          $('#myModal').modal('show');
        },
        edit:function(data){
          this.form.errors.clear();
          this.heading = "Edit Assessment - "+this.subjectName;
          this.assessIndex = this.assess.indexOf(data);
          console.log(this.assessIndex);
          console.log(data);
          this.editing = true;
          this.form.edit(data);
          $('#myModal').modal('show');
        }
    }
  }
</script>
