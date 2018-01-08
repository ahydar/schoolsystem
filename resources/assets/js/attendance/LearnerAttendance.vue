<template>
    <div>
        <div class="row">
            <div class="col-md-4">
                <div class="input-group date" id="picker" data-provide="datepicker">
                    <input type="text" id="input" class="form-control" data-date-format="dd/mm/yyyy">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <classlist @announce="setForm"></classlist>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary" @click="print()">Get Data</button>
            </div>
         </div>
          <div class="row" id="row">
            <div class="col-md-12">

                <modal modalID="myModal">
                <div slot="header">
                  <h3>Attendance for:</h3>
                </div>
                <div slot="body">
                  <form @submit.prevent="save">
                      <div class="form-group">
                        <select class="selectpicker" name="status" ref='select' v-model="status">
                            <option v-for="option in options" :value="option.status" :data-content="option.content">
                                {{option.status}}
                            </option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="usr">Reason:</label>
                        <textarea v-model="reason" class="form-control">

                        </textarea>
                      </div>
                      <button type="submit"  class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </modal>

                <div class="panel panel-default" v-if="learners.length > 0">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <table  width="100%" class=" table table-bordered table-hover" :id="tableID">
                            <thead>
                            <tr>
                                <th>
                                    Surname, Name
                                </th>
                                <th v-for="day in week">
                                    {{day}}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="learner in learners">
                                <td>
                                    {{learner.lastName}}, {{learner.firstName}}
                                </td>
                                <td v-for="day in week">
                                <button 
                                    v-bind:class="setClass(learner['daily_attendance'][day]['status'])"
                                    @click="showDetails(learner,day)"> 
                                    {{learner['daily_attendance'][day]['status']}} 
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
         </div>
    </div>
</template>

<script>
import ClassList from '../ListComponents/ClassList';
import {dataTableLoad,destroyDataTable} from '../services/dataTablesService';
export default {
    components:{
        'classlist':ClassList,
    },
    data(){
        return{
            date:'',
            form_id:'',
            week:[],
            learners:[],
            tableID :"learnerAttendance",
            details:{},
            status:'',
            reason:'',
            day:'',
            options:[
                {status:"Present",content:"<span class='label label-success'>Present</span>"},
                {status:"Absent",content:"<span class='label label-danger'>Absent</span>"},
                {status:"Late",content:"<span class='label label-warning'>Late</span>"},
                {status:"Left Early",content:"<span class='label label-info'>Left Early</span>"}
            ]
        }
    },
    created() {
          this.$root.pageHead = "Learner Daily Attendance";
    },
    mounted(){
        console.log(this.date);
        var container = $("#picker");
        $('.input-group.date').datepicker({
            format: 'dd-mm-yyyy',
            daysOfWeekDisabled:'06',
            container: container,
            todayHighlight: true,
            autoclose: true,
            disableTouchKeyboard:true,
            endDate: '0d'
        }).datepicker("setDate",'now');
    },
    update(){
        $(this.$refs.select).selectpicker('refresh');
    },
    methods:{
        print:function(){
            if(this.form_id){
                var d = $("#input").val();
                var date = moment(d,"DD-MM-YYYY");
                
                var start = 1 - date.day();
                var counter = 0;

                while(counter < 5){
                var duration = moment.duration({'days' : start})
                this.week[counter] = moment(d,"DD-MM-YYYY").add(duration).format("DD-MM-YYYY");
                counter++;
                start++;
                }
            }else{
                alert("Select a class please");
            }
            var data = {"form_id":this.form_id,week:this.week};

            console.log(data);

            var self = this;
            axios.post('/attendance/'+this.form_id,data).then(results => {
                    console.log(results.data);
                    self.learners = results.data;
                    destroyDataTable(self.tableID);
                    dataTableLoad(self.tableID);
            });
        },
        setForm:function(form_id){
            this.form_id = form_id;
        },
        setClass:function(status){
            if(status === "Present"){
                return "btn btn-success btn-xs";
            }else if(status === "Absent"){
                return "btn btn-danger btn-xs";
            }else if(status === "Left Early"){
                return "btn btn-info btn-xs";
            }else if(status === "Late"){
                return "btn btn-warning btn-xs";
            }else{
                return "btn btn-default btn-xs";
            }
        },
        showDetails:function(learner,day){
                this.day = day;
                this.status = learner['daily_attendance'][day]['status'];
                this.reason = learner['daily_attendance'][day]['reason'];
                this.details = learner;
                this.details['daily_attendance'][this.day]['user_id'] = learner.id;
                $("#myModal").modal("show");
                
                $('.selectpicker').selectpicker('val',this.status);
        },
        save:function(){
                this.details['daily_attendance'][this.day]['status'] = this.status;
                this.details['daily_attendance'][this.day]['reason'] = this.reason;
                console.log(this.details['daily_attendance'][this.day]);
                axios.post('/attendance',this.details['daily_attendance'][this.day]).then(response =>{
                        console.log(response.data);
                });
        }
    }
}
</script>
<style>
#row{
    margin-top:10px;
}
</style>
