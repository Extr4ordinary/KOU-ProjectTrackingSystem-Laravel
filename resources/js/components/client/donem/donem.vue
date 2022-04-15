<template>
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Dönemler <small> </small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <div class="col-md-1">
                                <select type="select" class="btn btn-primary btn-sm" v-model="search">
                                    <option value="">Dönem Filtrele</option>
                                    <option value="Bahar">Bahar</option>
                                    <option value="Güz">Güz</option>
                                </select>
                            </div>
                        </ul>
                        <ul class="nav navbar-right panel_toolbox">
                            <div class="col-md-4">
                                <button class="btn btn-success btn-sm" style="width:300px" @click="donemAktiveEt()">
                                    Aktif Dönem Takibi Başlat
                                </button>
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
                                        <button type="button" id="modal" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg12">Yeni Ekle</button>
                                    </div>

                                    </p>
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="max-width:100px">#</th>
                                                <th>Dönem</th>
                                                <th>Yıl</th>
                                                <th>Durum</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in forms" :key="item.id" :index="index">
                                                <td style="width:150px !important">
                                                    <i class="fa fa-edit  text-success pr-3" style="font-size:20px; cursor:pointer" @click="edit(index, 1)" title="Düzenleme yapmak için tıklayınız"></i>
                                                    <i class="fa fa-trash  text-danger  pr-3" style="font-size:20px ; cursor:pointer" @click="removeT(item.id)" title="Kişiyi silmek için tıklayınız"></i>
                                                    <i class="fa fa-code-fork  text-success" style="font-size:20px ; cursor:pointer" @click="makeOpened(item.id)" title="Dönemi aktif Yapmak İçin Tıklayınız"></i>
                                                </td>
                                                <td>{{item.name}}</td>

                                                <td>{{item.yil}}</td>
                                                <td>{{item.opened == 1 ? 'Aktif Dönem' : 'Pasif'}}</td>

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

    <div class="modal fade bs-example-modal-lg12" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Dönem Ekle / Düzenle</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="POST" @submit.prevent="onSubmit">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dönem Adı</label>
                                    <select type="text" :class="['form-control ', $v.form.name.$error ? 'is-invalid' : '']" v-model="form.name" @input="$v.form.name.$touch()">
                                        <option value="">Seçiniz</option>
                                        <option value="Güz">Güz</option>
                                        <option value="Bahar">Bahar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Yıl</label>
                                    <select name="" v-model="form.yil" id="" class="form-control">ü
                                        <option value="">Seçniz</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary" @click="add()" :disabled="$v.form.$invalid" v-if="edit_">Kaydet</button>
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
            forms: [],
            o_forms: [],
            search: '',
            edit_: true,
            form: {
                name: '',
                yil: '',
                opened: ''
            }
        };
    },
    validations() {
        return {
            form: {
                name: { required: required },
                yil: { required }
            }

        }
    },

    methods: {

        load() {
            axios.post("/takip/donem-data").then((response) => {
                this.forms = response.data;
                this.o_forms = response.data
            });
        },

        edit(index, type) {
            if (type === 1) {
                this.edit_ = true
            } else {
                this.edit_ = false
            }
            this.form = this.forms[index];
            document.getElementById('modal').click();
        },
        removeT(id) {
            axios.post('/takip/donem-delete/' + id)
                .then(response => {
                    successModal('Başarılı', 'İşlem Başarılı');
                    this.load();

                })
                .catch(err => {
                    errorModal('Başarısız', 'İşlem Başarısız');
                    console.log(err);
                });
        },
        makeOpened(id) {

            const control = confirm('Dönemi Açmak İstediğinize emin misiniz ?')
            if (!control) {
                return
            }
            axios.post('/takip/donem-active/' + id)
                .then(response => {
                    successModal('Başarılı', 'İşlem Başarılı');
                    this.load();

                })
                .catch(err => {
                    errorModal('Başarısız', 'İşlem Başarısız');
                    console.log(err);
                });
        },
        donemAktiveEt() {
            const active_ = this.forms.filter(item=>{ return item.opened==1});
            console.log(active_);
            if (active_.length==1) {
                 Swal.fire({
                title: active_[0].name+' '+active_[0].yil+' dönemi için takibi başlatmak istediğinize emin misiniz ?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Eminim',
                cancelButtonText: 'Kapat',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('/takip/takip-start/' +active_.id)
                        .then(response => {
                            Swal.fire('İşlem Başarılı', '', 'success')
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Proje Yürütücüsü ve Proje Öğrencisi eşlentirmeleri başarıyla gerçekleştirildi.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            this.load();

                        })
                        .catch(err => {
                            errorModal('Başarısız', 'İşlem Başarısız');
                            console.log(err);
                        });
                } else if (result.isDenied) {
                    Swal.fire('Değişiklik Yapılamadı', '', 'info')
                }
            })

            } else {
                errorModal('Lütfen Aktif Dönem Seçimi Yapınız')
            }
           
        },
        add() {
            var formData = new FormData();

            formData.append('name', this.form.name);
            formData.append('yil', this.form.yil);
            if (this.form.id) {
                formData.append('id', this.form.id);

            }

            axios.post('/takip/donem-add', formData)
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
    watch: {
        'search': function () {
            this.forms = this.o_forms.filter(item => {
                return item.name.toLowerCase().includes(this.search.toLowerCase());
            })
        }
    }
};
</script>
