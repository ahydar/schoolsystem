<template>
    <div>
         <div class="alert alert-info" v-if="changed">
                <strong>Changes Detected!</strong> Data change was detected on this page. Save when done with all changes.
                <button class="btn btn-primary"  @click="save()">Save Changes</button>
        </div>
        <div class="alert alert-warning" v-if="saving">
                <strong>Saving Changes</strong> <span><i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i></span>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Term marks
            </div>
            <div class="panel-body">
                <table  width="100%" class=" table table-bordered table-hover" :id="tableID">
                    <thead>
                    <tr>
                        <th v-for="col in columns">
                            {{col.title}}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="learner in learners">
                        <td v-for="col in columns" v-if="!col.editable">
                            {{learner[col.field]}}
                        </td>
                        <td v-for="col in columns" v-if="col.editable">
                            <input type="text" class="form-control" 
                            :value="learner[col.field]" 
                            @input="editted(learner,$event)" 
                            size=3
                            v-bind:disabled = "saving"
                            >
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<style>

</style>
<script>
  import {dataTableLoad,destroyDataTable} from '../services/dataTablesService';
  export default {
    props:{
       formsubject_id: {
         type: Number,
         required: true // User can accept a userData object on params, or not. It's totally optional.
       }
    },
    watch:{
        formsubject_id:function(newVal){
            var self = this;
            axios.get('/learnerassessments/'+newVal).then(function(result){
                self.learners = result.data; 
                self.createTable(self.learners);
            });
        }
    },
    data(){
      return {
        tableID:'learners',
        learners:[],
        changed:false,
        saving:false,
        assessMark:'',
        assessName:'',
        columns:[
          {title:'Last Name',field:'lastName',editable:false},          
          {title:'First Name',field:'firstName',editable:false},
          {title:'Term 1',field:'mark1',editable:true},
          {title:'Term 2',field:'mark2',editable:true},
          {title:'Term 3',field:'mark3',editable:true},
          {title:'Term 4',field:'mark4',editable:true},
          {title:'Final',field:'final',editable:true}
        ]
      }
    },
    mounted(){
        var self = this;
        axios.get('/learnermarks/'+this.formsubject_id).then(function(result){
            self.learners = result.data;
            self.createTable(self.learners);
        });
        
    },
    methods:{
        announce:function(){
          if(this.assess_id === 0){
              console.log("No Announcement");
          }else{
              console.log("Announce : "+this.assess_id);
              this.$emit('announce',this.assess_id);
          }
        },
        createTable:function(learners){
            this.assessMark = learners[0].assessMark;
            this.assessName = learners[0].assessName;
            console.log();
            this.learners = learners;
            destroyDataTable(this.tableID);
            dataTableLoad(this.tableID);
        },
        editted:function(data,event){
            var val = event.target.value.trim();
            data.mark = val;
            var check = this.learners.some(function(element){
                        return element.mark != element.originalMark && element.mark;
            },this);
            if(check ){
                this.changed = true;
            }else{
                this.changed = false;
            }
        },
        save:function(){
            var saveData = this.learners.filter(function(element){
                    return element.mark != element.originalMark && element.mark; 
            });
            var self = this;
            self.changed = false;
            self.saving = true;
            axios.post('/learnerassessments',saveData).then(function(result){
                self.learners = result.data; 
                console.log(result.data);
                self.saving = false;
            });
        },
    }
  }
</script>
