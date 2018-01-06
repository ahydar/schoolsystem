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
                <classlist @announce="setClass"></classlist>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary" @click="print()">Get Data</button>
            </div>
         </div>
          <div class="row">
            <div class="col-md-12">
                <fileupload></fileupload>
            </div>
         </div>
    </div>
</template>

<script>
import ClassList from '../ListComponents/ClassList';
import UploadFile from '../components/UploadFile';
export default {
    components:{
        'classlist':ClassList,
        'fileupload':UploadFile
    },
    data(){
        return{
            date:'',
            form_id:'',
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
    methods:{
        print:function(){
            if(this.form_id){
                console.log($("#input").val());
                console.log(this.form_id);
            }else{
                alert("Select a class please");
            }
        },
        setClass:function(form_id){
            this.form_id = form_id;
        }
    }
}
</script>

