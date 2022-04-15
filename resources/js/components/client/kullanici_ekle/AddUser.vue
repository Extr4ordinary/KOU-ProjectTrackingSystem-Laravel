<template>
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Kullanıcılar <small> </small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                             <div class="col-md-1">
                                        <select type="select" id="modal" class="btn btn-primary btn-sm" v-model="search">
                                        <option value="">Kullanıcı Tipi</option>
                                        <option value="sistem-yoneticisi">Sistem Yöneticisi</option>
                                        <option value="proje-yurutucusu">Proje Yürütücüsü</option>
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
                                        <button type="button" id="modal" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg21">Yeni Ekle</button>
                                    </div>
                                  
                                    </p>
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="max-width:100px">#</th>
                                                <th>İsim Soyisim</th>
                                                <th>Email</th>
                                                <th>Unvan </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in forms" :key="item.id" :index="index">
                                                <td style="width:150px !important">
                                                    <i class="fa fa-edit  text-success pr-3" style="font-size:20px; cursor:pointer" @click="edit(index,1)" title="Düzenleme yapmak için tıklayınız"></i>
                                                    <i class="fa fa-trash  text-danger  pr-3" style="font-size:20px ; cursor:pointer" @click="removeT(item.id)" title="Kişiyi silmek için tıklayınız"></i>
                                                    <i class="fa fa-eye  text-success" style="font-size:20px ; cursor:pointer" @click="edit(index,2)" title="Kişi bilgilerini görmek için tıklayınız"></i>
                                                </td>
                                                <td>{{item.ad + item.soyad}}</td>

                                                <td>{{item.eposta}}</td>

                                                <td>{{(item.unvan == 'sistem-yoneticisi') ? 'Sistem Yöneticisi':((item.unvan =='proje-ogrencisi') ? 'Proje Öğrencisi' :(item.unvan =='proje-yurutucusu') ? 'Proje Yürütücüsü' : '') }}</td>
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

    <div class="modal fade bs-example-modal-lg21" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Kullanıcı Ekle</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="POST"  @submit.prevent="onSubmit">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sistem Yöneticisi</label>
                                    <input type="radio" name="unvan" class="form-control" value="sistem-yoneticisi" v-model="form.unvan">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Proje Yürütücü</label>
                                    <input type="radio" name="unvan" class="form-control" value="proje-yurutucusu" v-model="form.unvan">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Proje Öğrencisi</label>
                                    <input type="radio" name="unvan" class="form-control" value="proje-ogrencisi" v-model="form.unvan">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" >Ad</label>
                                    <input type="text" :class="['form-control ', $v.form.ad.$error ? 'is-invalid' : ''] " v-model="form.ad" @input="$v.form.ad.$touch()">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Soyad</label>
                                    <input type="text"  :class="['form-control ', $v.form.soyad.$error ? 'is-invalid' : ''] " v-model="form.soyad" @input="$v.form.soyad.$touch()">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" :class="['form-control ', $v.form.eposta.$error ? 'is-invalid' : ''] " v-model="form.eposta" @input="$v.form.eposta.$touch()">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12" v-show="form.unvan == 'proje-ogrencisi'">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Öğrenci No</label>
                                    <input type="number" class="form-control" v-model="form.person.ogrenciNo">
                                    <!-- :class="['form-control ', $v.form.person.ogrenciNo.$error ? 'is-invalid' : ''] " v-model="form.person.ogrenciNo" @input="$v.form.person.ogrenciNo.$touch()" -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Fakülte</label>
                                    <input type="text" class="form-control" v-model="form.person.fakulte">
                                    <!-- :class="['form-control ', $v.form.person.fakulte.$error ? 'is-invalid' : ''] " v-model="form.person.fakulte" @input="$v.form.person.fakulte.$touch()" -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Bölüm</label>
                                    <input type="text" class="form-control"  v-model="form.person.bolum">
                                    <!-- :class="['form-control ', $v.form.person.bolum.$error ? 'is-invalid' : ''] " v-model="form.person.bolum" @input="$v.form.person.bolum.$touch()" -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sınıf</label>
                                    <input type="number" class="form-control" v-model="form.person.sinif">
                                    <!-- :class="['form-control ', $v.form.person.sinif.$error ? 'is-invalid' : ''] " v-model="form.person.sinif" @input="$v.form.person.sinif.$touch()" -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cep Telefonu</label>
                                    <input type="number" class="form-control"  v-model="form.person.cep">
                                    <!-- :class="['form-control ', $v.form.person.cep.$error ? 'is-invalid' : ''] " v-model="form.person.cep" @input="$v.form.person.cep.$touch()" -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Fotoğraf</label>
                                    <input type="file" class="form-control" @change="fileUpload($event)">
                                     <!-- :class="['form-control ', $v.form.person.image.$error ? 'is-invalid' : ''] " v-model="form.person.image" @input="$v.form.person.image.$touch()" -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary" @click="add()"  :disabled="$v.form.$invalid" v-if="edit_">Kaydet</button>
                </div>

            </div>
        </div>
    </div>
      <!-- person: {
                  ogrenciNo: ()=>{return (this.form.unvan =='proje-ogrencisi') ? false : required},
                  fakulte: ()=>{return (this.form.unvan =='proje-ogrencisi') ? false : required},
                  bolum: ()=>{return (this.form.unvan =='proje-ogrencisi') ? false : required},
                  sinif: ()=>{return (this.form.unvan =='proje-ogrencisi') ? false : required},
                  cep: ()=>{return (this.form.unvan =='proje-ogrencisi') ? false : required},
                  //image : ()=>{return (this.form.unvan =='proje-ogrencisi') ? false : required},
              } -->
</div>
</template>

<script>
import { required, email } from 'vuelidate/lib/validators';

export default {

    data() {
        return {
            ad:"efe",
            forms: [],
            o_forms: [],
            search: '',
            edit_:true,
            form: {
                unvan:'',
                ad: '',
                soyad:'',
                eposta: '',
                person: {
                    ogrenciNo :'',
                    fakulte: '',
                    bolum: '',
                    sinif : '',
                    cep : '',
                    image: ''
                }
            },
        };
    },
    validations() {
        return {
          form:{
              ad: { required: required },
              unvan : { required},
              soyad: {required},
              eposta : { required, email},
            
          }
        
        }
    },

    methods: {

        load() {
            axios.post("/takip/user-data").then((response) => {
                this.forms = response.data;
                this.o_forms = response.data
            });
        },
        fileUpload(e) {
            this.$set(this.form, 'loadFile', e.target.files[0]);
        },

        edit(index,type) {
            if (type===1) {
                this.edit_ = true
            } else {
                    this.edit_ = false
            }
            this.form = this.forms[index];
            document.getElementById('modal').click();
        },
        removeT(id) {
            axios.post('/takip/user-delete/' + id)
                .then(response => {
                    successModal('Başarılı', 'İşlem Başarılı');
                    this.load();

                })
                .catch(err => {
                    errorModal('Başarısız', 'İşlem Başarısız');
                    console.log(err);
                });
        },
        add() {
            var formData = new FormData();

            formData.append('ad', this.form.ad);
            formData.append('soyad', this.form.soyad);
            formData.append('eposta', this.form.eposta);
            formData.append('unvan', this.form.unvan);
            formData.append('bolum', this.form.person.bolum);
            formData.append('ogrenciNo', this.form.person.ogrenciNo);
            formData.append('cep', this.form.person.cep);
            formData.append('fakulte', this.form.person.fakulte);
            formData.append('sinif', this.form.person.sinif);
            if (this.form.id) {
                formData.append('id', this.form.id);
            }
            if (this.form.loadFile) {
                formData.append('image', this.form.loadFile, this.form.loadFile.name);
            }
            axios.post('/takip/user-add', formData)
                .then(response => {

                    successModal('Başarılı', 'İşlem Başarılı');
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
        'search':function(){
            this.forms = this.o_forms.filter(item=>{
                return item.unvan.toLowerCase().includes(this.search.toLowerCase());
            })
        }
    }
};
</script>
