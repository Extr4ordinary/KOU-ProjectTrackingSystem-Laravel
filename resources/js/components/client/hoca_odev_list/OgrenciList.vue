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
                                <select type="select" class="btn btn-primary btn-sm" v-model="search">
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
                                        <button type="button" id="modal" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg33">Yeni Ekle</button>
                                        <button type="button" id="project" style="display: none" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".projects">Yeni Ekle</button>
                                        <button type="button" id="rapor_tez" style="display: none" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".rapor_tez">Yeni Ekle</button>
                                        <button type="button" id="rapor_tezzz" style="display: none" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".rapor_tezzz">Yeni Ekle</button>
                                    </div>

                                    </p>
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="max-width:100px">#</th>
                                                <th>İsim Soyisim</th>
                                                <th>Email</th>
                                                <th>Telefon</th>
                                                <th>Sınıf</th>
                                                <th>Öğrenci No</th>
                                                <th>Proje Başlığı </th>
                                                <th>Proje Durumu </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in forms" :key="item.id" :index="index">
                                                <td style="width:150px !important">
                                                    <i :class="['fa fa-eye', item.get_projects.length > 0 && item.get_projects[0].seen == 'Görüldü' ? 'text-success' : 'text-danger']" style="font-size:20px ; cursor:pointer" @click="edit(index)" title="Ödev detaylarını Görmek için tıklayınız"></i>
                                                </td>
                                                <td>{{item.ad + item.soyad}}</td>
                                                <td>{{item.eposta}}</td>
                                                <td>{{item.person && item.person.cep ? item.person.cep : ''}}</td>
                                                <td>{{item.person && item.person.sinif ? item.person.sinif : ''}}</td>
                                                <td>{{item.person && item.person.ogrenciNo ? item.person.ogrenciNo : ''}}</td>

                                                <!-- <td>{{item.eposta}}</td> -->

                                                <!-- <td>{{(item.unvan == 'sistem-yoneticisi') ? 'Sistem Yöneticisi':((item.unvan =='proje-ogrencisi') ? 'Proje Öğrencisi' :(item.unvan =='proje-yurutucusu') ? 'Proje Yürütücüsü' : '') }}</td> -->
                                                <td>{{item.get_projects.length>0 ? item.get_projects[item.get_projects.length-1].baslik: '' }}</td>
                                                <td>{{item.get_projects.length>0 ? item.get_projects[item.get_projects.length-1].durum: '' }}</td>
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

    <div class="modal fade bs-example-modal-lg33" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> {{form.ad + ' ' + form.soyad}}</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="POST" @submit.prevent="onSubmit">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ad</label>
                                    <input type="text" class="form-control" v-model="form.ad" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Soyad</label>
                                    <input type="text" class="form-control" v-model="form.soyad" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" v-model="form.eposta" disabled>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="max-width:100px">#</th>
                                        <th>Proje Başlığı </th>
                                        <th>Proje Durumu </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in form.get_projects" :key="item.id" :index="index">
                                        <td style="width:150px !important">
                                            <i :class="['fa fa-eye', item.seen == 'Görüldü' ? 'text-success' : 'text-danger']" style="font-size:20px ; cursor:pointer" @click="edit_projects(index)" title="proje detaylarını görmek için tıklayınız"></i>
                                            <i :class="['fa fa-file', item.durum != 'Devam Eden Proje' ? 'text-success' : 'text-danger']" style="font-size:15px ; cursor:pointer" @click="edit_rapor(index)" title="Kişi bilgilerini görmek için tıklayınız"></i>
                                            <i :class="['fa fa-file', item.durum.includes('Tez') ? 'text-success' : 'text-danger']" style="font-size:15px ; cursor:pointer" @click="edit_tez(index)" title="Bu buton proje Tez aşamasında iken açılır ve tez aşamasındaki dosyaları barındırır "></i>
                                        </td>
                                        <!-- <td>{{item.eposta}}</td> -->

                                        <!-- <td>{{(item.unvan == 'sistem-yoneticisi') ? 'Sistem Yöneticisi':((item.unvan =='proje-ogrencisi') ? 'Proje Öğrencisi' :(item.unvan =='proje-yurutucusu') ? 'Proje Yürütücüsü' : '') }}</td> -->
                                        <td>{{item.baslik }}</td>
                                        <td>{{item.durum }}</td>
                                    </tr>
                                </tbody>
                            </table>
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
    <div class="modal fade bs-example-modal-lg33 projects" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> {{form.ad + ' ' + form.soyad}}</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="POST" @submit.prevent="onSubmit">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ad</label>
                                    <input type="text" class="form-control" v-model="form.ad" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Soyad</label>
                                    <input type="text" class="form-control" v-model="form.soyad" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" v-model="form.eposta" disabled>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Başlık</label>
                                    <input type="text" class="form-control" v-model="project.baslik" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Anahtar Kelimeler</label>
                                    <input type="text" class="form-control" v-model="project.anahtar_kelime" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Projenin amacını, önemini ve kapsamı</label>
                                    <textarea type="text" class="form-control" rows="12" v-model="project.amac" disabled></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Materyal, yöntem ve araştırma olanakları</label>
                                    <textarea type="text" class="form-control" rows="12" v-model="project.metaryel" disabled></textarea>
                                </div>
                                <div class="form-group" v-if="red_nedeni">
                                    <label for="exampleInputEmail1">Red Nedenini Açıklayınız ?</label>
                                    <textarea type="text" class="form-control" rows="3" v-model="red_nedeni"></textarea>
                                </div>
                                <div class="form-group" v-if="project.durum == 'Red Edildi'">
                                    <label for="exampleInputEmail1">Red Nedeni</label>
                                    <textarea type="text" class="form-control" rows="3" v-model="project.red_nedeni" disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <div v-if="project.durum != 'Red Edildi'">
                        <button type="button" class="btn btn-success" @click="onay()">Onayla</button>
                        <button type="button" class="btn btn-danger" @click="red()" v-if="!red_nedeni">Red Et</button>
                        <button type="button" class="btn btn-danger" @click="red2()" v-else>Red Et</button>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg33 rapor_tezzz" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Tez Aşaması</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="POST" @submit.prevent="onSubmit()">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tez Aşaması</label>
                                    <input type="radio" class="form-control" value="sistem-yoneticisi" checked>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 pt-5 pb-5" v-if="project.tez_pdf">
                            <div class="col-md-4">
                                <a :href="'/public/files/' + project.tez_word" class="alert alert-success alert-dismissible " role="alert" download="">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Docs</strong>Yüklenen Tezi İndirmek İçin
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a :href="'/public/files/' + project.tez_word2" class="alert alert-success alert-dismissible " role="alert" download="">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Docs</strong>Yüklenen Tezi İndirmek İçin
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a :href="'/public/files/' + project.tez_pdf" class="alert alert-success alert-dismissible " role="alert" download="">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Docs</strong>Yüklenen Tezi İndirmek İçin
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" v-if="red_nedeni">
                                <label for="exampleInputEmail1">Red Nedenini Açıklayınız ?</label>
                                <textarea type="text" class="form-control" rows="3" v-model="red_nedeni"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <div v-if="project.durum != 'Tez Red Edildi'">
                        <button type="button" class="btn btn-success" @click="onay_tez()">Onayla</button>
                        <button type="button" class="btn btn-danger" @click="red()" v-if="!red_nedeni">Red Et</button>
                        <button type="button" class="btn btn-danger" @click="red_tez()" v-else>Red Et</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg33 rapor_tez" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Rapor Aşaması</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="POST" @submit.prevent="onSubmit()">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Rapor Aşaması</label>
                                    <input type="radio" class="form-control" value="sistem-yoneticisi" checked>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 pt-5 pb-5" v-if="project.rapor_pdf">
                            <div class="col-md-4">
                                <a :href="'/public/files/' + project.rapor_word" class="alert alert-success alert-dismissible " role="alert" download="">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Docs</strong>Yüklenen Tezi İndirmek İçin
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a :href="'/public/files/' + project.rapor_word2" class="alert alert-success alert-dismissible " role="alert" download="">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Docs</strong>Yüklenen Tezi İndirmek İçin
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a :href="'/public/files/' + project.rapor_pdf" class="alert alert-success alert-dismissible " role="alert" download="">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Docs</strong>Yüklenen Tezi İndirmek İçin
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" v-if="red_nedeni">
                                <label for="exampleInputEmail1">Red Nedenini Açıklayınız ?</label>
                                <textarea type="text" class="form-control" rows="3" v-model="red_nedeni"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <div v-if="project.durum != 'Tez Red Edildi' ">
                        <button type="button" class="btn btn-success" @click="onay_tez()">Onayla</button>
                        <button type="button" class="btn btn-danger" @click="red()" v-if="!red_nedeni">Red Et</button>
                        <button type="button" class="btn btn-danger" @click="red_tez()" v-else>Red Et</button>
                    </div>
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
            ad: "efe",
            forms: [],
            o_forms: [],
            search: '',
            red_nedeni: false,
            edit_: true,
            project: {},
            form: {},
        };
    },
    validations() {
        return {
            form: {

            }

        }
    },

    methods: {
        red() {
            this.red_nedeni = "Onaylanmama Sebebi ?  "
        },
        red2() {
            var con1firm = confirm('Red Etmek istediğinize emin misiniz ?')
            if (!con1firm) {
                return
            }
            axios.post('/takip/proje-revize/'+this.project.id, {  red_nedeni: this.red_nedeni })
                .then(response => {
                    successModal('Başarılı', 'İşlem Başarılı');
                    this.load();

                })
                .catch(err => {
                    errorModal('Başarısız', 'İşlem Başarısız');
                    console.log(err);
                });
        },
        rapor_red() {
            var con1firm = confirm('Red Etmek istediğinize emin misiniz ?')
            if (!con1firm) {
                return
            }
            axios.post('/takip/proje-rapor-red/'+this.project.id, {red_nedeni: this.red_nedeni })
                .then(response => {
                    successModal('Başarılı', 'İşlem Başarılı');
                    this.load();

                })
                .catch(err => {
                    errorModal('Başarısız', 'İşlem Başarısız');
                    console.log(err);
                });
        },
        red_tez() {
            var con1firm = confirm('Red Etmek istediğinize emin misiniz ?')
            if (!con1firm) {
                return
            }
            axios.post('/takip/proje-tez-red/'+this.project.id, {  red_nedeni: this.red_nedeni })
                .then(response => {
                    successModal('Başarılı', 'İşlem Başarılı');
                    this.load();

                })
                .catch(err => {
                    errorModal('Başarısız', 'İşlem Başarısız');
                    console.log(err);
                });
        },
        onay() {
            var con1firm = confirm('Onaylamak istediğinize emin misiniz ?')
            if (!con1firm) {
                return
            }
            axios.post('/takip/proje-onay/'+this.project.id)
                .then(response => {
                    successModal('Başarılı', 'İşlem Başarılı');
                    this.load();

                })
                .catch(err => {
                    errorModal('Başarısız', 'İşlem Başarısız');
                    console.log(err);
                });
        },
        onay_rapor() {
            var con1firm = confirm('Onaylamak istediğinize emin misiniz ?')
            if (!con1firm) {
                return
            }
            axios.post('/takip/proje-onay-rapor/'+this.project.id)
                .then(response => {
                    successModal('Başarılı', 'İşlem Başarılı');
                    this.load();

                })
                .catch(err => {
                    errorModal('Başarısız', 'İşlem Başarısız');
                    console.log(err);
                });
        },
        onay_tez() {
            var con1firm = confirm('Onaylamak istediğinize emin misiniz ?')
            if (!con1firm) {
                return
            }
            axios.post('/takip/proje-onay-tez/'+this.project.id)
                .then(response => {
                    successModal('Başarılı', 'İşlem Başarılı');
                    this.load();

                })
                .catch(err => {
                    errorModal('Başarısız', 'İşlem Başarısız');
                    console.log(err);
                });
        },

        load() {
            axios.post("/takip/ogrenciler-data").then((response) => {
                this.forms = response.data;
                this.o_forms = response.data
            });
        },
        fileUpload(e) {
            this.$set(this.form, 'loadFile', e.target.files[0]);
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
        edit_rapor(index) {
            this.project = this.form.get_projects[index];
            document.getElementById('rapor_tez').click();
            this.load();
            axios.post('/takip/proje-seen-rapor/' + this.project.id)
                .then(response => {
                    this.load();
                    this.project = this.form.get_projects[index];

                })
                .catch(err => {
                    errorModal('Başarısız', 'İşlem Başarısız');
                    console.log(err);
                });

        },
        edit_tez(index) {
            this.project = this.form.get_projects[index];
            document.getElementById('rapor_tezzz').click();
            this.load();
            axios.post('/takip/proje-seen-tez/' + this.project.id)
                .then(response => {
                    this.load();
                    this.project = this.form.get_projects[index];

                })
                .catch(err => {
                    errorModal('Başarısız', 'İşlem Başarısız');
                    console.log(err);
                });

        },
        edit_projects(index) {
            this.project = this.form.get_projects[index];
            document.getElementById('project').click();
            this.load();
            axios.post('/takip/proje-seen/' + this.project.id)
                .then(response => {
                    this.load();
                    this.project = this.form.get_projects[index];

                })
                .catch(err => {
                    errorModal('Başarısız', 'İşlem Başarısız');
                    console.log(err);
                });

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
    watch: {
        'search': function () {
            this.forms = this.o_forms.filter(item => {
                return item.unvan.toLowerCase().includes(this.search.toLowerCase());
            })
        }
    }
};
</script>
