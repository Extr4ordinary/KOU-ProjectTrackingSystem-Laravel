<template>
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Proje Durumu <small> </small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                             <div class="col-md-1">
                                        <select type="select"  class="btn btn-primary btn-sm" v-model="search">
                                        <option value="">Proje Durumu</option>
                                        <option value="sistem-yoneticisi">Devam Eden Proje</option>
                                        <option value="proje-yurutucusu">Biten Projeler</option>
                                        <option value="proje-ogrencisi">Proje Öğrencisi</option>
                                        
                                        </select>
                                    </div>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <p class="text-muted font-13 m-b-30">
                                    <div class="col-md-11">
                                        Tabloda sıralama türünü değiştirmek isterseniz ismin üzerine tıklamanız
                                        yeterlidir. <code>Örnek olarak ilk sütuna tıklayabilirsiniz</code>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" id="modal" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg">Yeni Ekle</button>
                                    </div>
                                  
                                    </p>
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="max-width:100px">#</th>
                                                <th>Başlık</th>
                                                <th>Amaç</th>
                                                <th>Metaryel </th>
                                                <th>Anahtar Kelime </th>
                                                <th>Proje Durumu</th>
                                                <th>Danışman</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in forms" :key="item.id" :index="index">
                                                <td style="width:150px !important">
                                                    <i class="fa fa-eye  text-success" style="font-size:20px ; cursor:pointer" @click="edit(index)" title="Detayları Görmek için tıklayınız"></i>
                                                </td>
                                                <td>{{item.baslik}}</td>
                                                <td>{{item.amac.slice(0,200)}}...</td>
                                                <td>{{item.metaryel.slice(0,200)}}...</td>
                                                <td>{{item.anahtar_kelime.slice(0,200)}}...</td>
                                                <td>{{item.durum}}</td>
                                                <td>{{item.danisman}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Kullanıcı Ekle</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="POST"  @submit.prevent="onSubmit()">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Proje Önerisi</label>
                                    <input type="radio" name="unvan" class="form-control" value="sistem-yoneticisi" checked>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" >Proje Başlığı</label>
                                    <input type="text" name="unvan" class="form-control" v-model="form.baslik" :class="['form-control ', $v.form.baslik.$error ? 'is-invalid' : ''] "  @input="$v.form.baslik.$touch()">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" :class="[lenght_anahtar_kelime == 5 ? 'text-success' : 'text-danger']">Proje Anahtar Kelime</label>
                                    <input type="text" name="unvan" class="form-control" v-model="form.anahtar_kelime" placeholder="anahtar_kelime1 anahtar_kelime2 ">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" :class="[lenght_amac >= 200 ? 'text-success' : 'text-danger']">Projenin amacını, önemini ve kapsamını açıklayınız </label>
                                    <textarea  class="form-control" v-model="form.amac" rows="7" placeholder="Proejnin amacaını en az 200 kelime ile anlatınız"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" :class="[lenght_metaryel >= 300 ? 'text-success' : 'text-danger']">Materyal, yöntem ve araştırma olanaklarını açıklayınız </label>
                                    <textarea  class="form-control" v-model="form.metaryel" rows="7" placeholder="en az 300 kelime ile anlatınız"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary" @click="add()"  v-if="lenght_metaryel >= 300 && lenght_amac >= 200 && lenght_anahtar_kelime == 5 && !$v.form.$anyError && editis">Kaydet</button>
                    <button type="button" class="btn btn-primary" v-else disabled>Kaydet</button>

                </div>

            </div>
        </div>
    </div>
</div>
</template>

<script>
import { required, email } from 'vuelidate/lib/validators';

export default {
    
    data() {
        return {
            ad:"efe",
            id: "",
            forms: [],
            o_forms: [],
            search: '',
            editis: true,
            lenght_amac: '',
            lenght_metaryel: '',
            lenght_anahtar_kelime: '',
            edit_:true,
            form: {
                baslik:'',
                amac: '',
                anahtar_kelime:'',
                metaryel: '',               
            },
        };
    },
    validations() {
        return {
          form:{
              baslik: { required: required },
              amac : { required},
              anahtar_kelime: {required},
              metaryel : { required, email},
            
          }
        
        }
    },

    methods: {
        removeT (){

        },
        load() {
            axios.post("/takip/proje-data").then((response) => {
                this.forms = response.data;
                this.o_forms = response.data
            });
        },
        fileUpload(e) {
            this.$set(this.form, 'loadFile', e.target.files[0]);
        },

        edit(index) {
            this.form = this.o_forms[index];
            this.editis = false;
            document.getElementById('modal').click();
        },
        add() {
            var formData = new FormData();

            formData.append('baslik', this.form.baslik);
            formData.append('amac', this.form.amac);
            formData.append('metaryel', this.form.metaryel);
            formData.append('anahtar_kelime', this.form.anahtar_kelime);

            axios.post('/takip/proje-add', formData)
                .then(response => {

                    successModal('Başarılı', 'İşlem Başarılı Proje Danışman Onayına Gönderildi.');
                    this.load();
                })
                .catch(err => {
                    errorModal('Başarısız', 'İşlem Başarısız');
                    console.log(err);
                })
        },

    },
    created() {
        this.load();
    },
    mounted() {

    },
     watch:{
        'form.amac':function(){
            var k = this.form.amac;
	   	    k = k.replace(/(^\s*) | (\s*$)/gi, "");
	   	    k = k.replace(/[ ]{2,}/gi, " ");
	   	    k = k.replace(/\n/, /"\n"/);
            return this.lenght_amac= k.split(' ').length;

        },
        'form.anahtar_kelime':function(){
            var k = this.form.anahtar_kelime;
	   	    k = k.replace(/(^\s*) | (\s*$)/gi, "");
	   	    k = k.replace(/[ ]{2,}/gi, " ");
	   	    k = k.replace(/\n/, /"\n"/);
            return this.lenght_anahtar_kelime= k.split(' ').length;

        },
        'form.metaryel':function(){
            var k = this.form.metaryel;
	   	    k = k.replace(/(^\s*) | (\s*$)/gi, "");
	   	    k = k.replace(/[ ]{2,}/gi, " ");
	   	    k = k.replace(/\n/, /"\n"/);
            return this.lenght_metaryel= k.split(' ').length;

        }
    }
};
</script>
