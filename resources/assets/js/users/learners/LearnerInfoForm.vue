<template>
    <div class="box box-success">
        <div class="box-header with-border">
        <h3 class="box-title">Learner Details</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form @submit.prevent="save" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)" role="form">
            <!-- text input -->
            <inputform title="Surname" field="lastName" type="text" :required="true" :form="form"></inputform>

            <inputform title="Name" field="firstName" type="text" :required="true" :form="form"></inputform>

            <inputform title="Date of birth" field="dob" type="text" :form="form"></inputform>
             
            <selectform
                title="Gender"
                field = "gender"
                :form = "form"
                :items = "[{status:'Male'},{status:'Female'}]"
                :names = "{value:'status',display:'status'}"
                :required="true"
            ></selectform>

            <inputform title="Email" field="email" type="email" :form="form" :required="true"></inputform>

            <inputform title="Phone" field="phone" type="text" :form="form"></inputform>

            <textareaform title="Address" field="address" :form="form"></textareaform>

            <inputform title="Postal Code" field="postalCode" type="text" :form="form"></inputform>

            <inputform title="Nationality" field="nationality" type="text" :form="form"></inputform>

            <inputform title="ID/Pass No." field="idNumber" type="text" :form="form"></inputform>

            <selectform
                title="Marital Status"
                field = "maritalStatus"
                :form = "form"
                :items = "[{status:'Married'},{status:'Single'}]"
                :names = "{value:'status',display:'status'}"
            ></selectform>

            <inputform title="Total Annual Tuition Fee" field="totalFees" type="text" :form="form"></inputform>

            <selectform
                v-if="classes.length > 0"
                title="Class"
                field = "form_id"
                :form = "form"
                :items = "classes"
                :names = "{value:'id',display:'formName'}"
                :required="true"
            ></selectform>

            <div class="form-group">
                <button type="submit" class="btn btn-success form-control">Next</button>
            </div>

            </form>
        </div>
        <!-- /.box-body -->
    </div>  
</template>
<script>
  import {Form} from '../../services/form';
  import Input from '../../formComponents/Input';
  import Select from '../../formComponents/Select';
  import TextArea from '../../formComponents/TextArea';
  import DateInput from '../../formComponents/Date';
  export default {
    props:{
       learner: {
         type: Object,
         required: false // User can accept a userData object on params, or not. It's totally optional.
       }
    },
    components:{
      'inputform':Input,
      'selectform':Select,
      'textareaform':TextArea,
      'dateinput':DateInput
    },
    data(){
      return {
        header:'New Learner',
        classes:[],
        action:'post',
        url:'/learnerinfo',
        form: new Form({
            form_id:'',
            firstName:'',
            lastName:'',
            dob:'',
            gender:'',
            email:'',
            phone:'',
            address:'',
            postalCode:'',
            nationality:'',
            idNumber:'',
            maritalStatus:'',
            totalFees:''
        })
      }
    },
    mounted(){
        var self = this;
        axios.get('classes').then(function(result){
            self.classes = result.data.classes;
        });
        console.log('Mounted');
        if(this.learner){
          this.action = 'patch';
          this.url = '/learnerinfo/'+this.learner.id;
          this.form.edit(this.learner);
          console.log(this.learner);
        }
    },
    methods:{
      save:function(){
        var self = this;
        this.form.submit(self.action,this.url).then(function(result){
                console.log(result);
                if(result.exists){
                    alert(result.exists);
                }else{
                    self.$emit('addGaurdian',result);
                }
                //console.log(result);
        });
      }
    }
  }
</script>
