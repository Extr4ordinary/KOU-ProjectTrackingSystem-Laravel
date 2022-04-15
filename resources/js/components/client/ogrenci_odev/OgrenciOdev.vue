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
                                <select type="select" class="btn btn-primary btn-sm" v-model="search">
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
                                        <button type="button" id="modal" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg23" :disabled="durum == 'Devam Eden Proje'">Yeni Ekle</button>
                                        <button type="button" id="modal2" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg23" style="display:none">Yeni Ekle</button>
                                        <button type="button" id="rapor_tez" class="btn btn-primary btn-sm" style="display:none" data-toggle="modal" data-target=".rapor_tez">Yeni Ekle</button>
                                        <button type="button" id="rapor_tezz" class="btn btn-primary btn-sm" style="display:none" data-toggle="modal" data-target=".rapor_tezz">Yeni Ekle</button>
                                    </div>

                                    </p>
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="max-width:40px !important">Proje Önerisi</th>
                                                <th style="max-width:100px">Rapor Aşaması</th>
                                                <th style="max-width:100px">Tez Aşaması</th>
                                                <th>Başlık</th>
                                                <th>Amaç</th>
                                                <th>Metaryel </th>
                                                <th>Anahtar Kelime </th>
                                                <th>Proje Durumu</th>
                                                <th>Danışman</th>
                                                <th>Görülme Durumu</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in forms" :key="item.id" :index="index">
                                                <td style="width:80px !important">
                                                    <i class="fa fa-eye  text-success" style="font-size:20px ; cursor:pointer" @click="edit(index)" title="Detayları Görmek için tıklayınız"></i>
                                                </td>
                                                <td style="width:80px !important">
                                                    <i :class="['fa fa-file', item.durum != 'Devam Eden Proje' && item.durum != 'Red Edildi' ? 'text-success' : 'text-danger']" :disabled="item.durum == 'Rapor Aşamasında'" style="font-size:15px ; cursor:pointer" @click="edit2(index)" title="Bu buton proje rapor aşamasında iken açılır ve rpoar aşamasındaki dosyaları barındırır "></i>
                                                </td>
                                                <td style="width:80px !important">
                                                    <i :class="['fa fa-file', item.durum.includes('Tez') ? 'text-success' : 'text-danger']" :disabled="item.durum == 'Tez Aşamasında'" style="font-size:15px ; cursor:pointer" @click="edit3(index, item.durum)" title="Bu buton proje Tez aşamasında iken açılır ve tez aşamasındaki dosyaları barındırır "></i>
                                                </td>
                                                <td>{{item.baslik}}</td>
                                                <td>{{item.amac.slice(0,200)}}...</td>
                                                <td>{{item.metaryel.slice(0,200)}}...</td>
                                                <td>{{item.anahtar_kelime.slice(0,200)}}...</td>
                                                <td>{{item.durum}}</td>
                                                <td>{{item.danisman}}</td>
                                                <td>{{item.seen ? item.seen :  'Görülmedi'}}</td>
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

    <div class="modal fade bs-example-modal-lg23" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Proje Önerisi</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="POST" @submit.prevent="onSubmit()">
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
                                    <label for="exampleInputEmail1">Proje Başlığı</label>
                                    <input type="text" name="unvan" class="form-control" v-model="form.baslik" :class="['form-control ', $v.form.baslik.$error ? 'is-invalid' : '']" @input="$v.form.baslik.$touch()">
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
                                    <textarea class="form-control" v-model="form.amac" rows="7" placeholder="Proejnin amacaını en az 200 kelime ile anlatınız"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" :class="[lenght_metaryel >= 300 ? 'text-success' : 'text-danger']">Materyal, yöntem ve araştırma olanaklarını açıklayınız </label>
                                    <textarea class="form-control" v-model="form.metaryel" rows="7" placeholder="en az 300 kelime ile anlatınız"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12" v-if="form.durum == 'Red Edildi'">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Red Nedeni </label>
                                    <textarea class="form-control" v-model="form.red_nedeni" rows="3" disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary" @click="add()" v-if="lenght_metaryel >= 300 && lenght_amac >= 200 && lenght_anahtar_kelime == 5 && !$v.form.$anyError && editis">Kaydet</button>
                    <button type="button" class="btn btn-primary" v-else disabled>Kaydet</button>

                </div>

            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg23 rapor_tez" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Proje Raporu *(doc/docx)</label>
                                    <input type="file" class="form-control" @change="fileUpload($event, 'projeDocs')" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Proje Raporu *(pdf)</label>
                                    <input type="file" class="form-control" @change="fileUpload($event, 'projePdf')" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Proje Raporu *(doc/docx)</label>
                                    <input type="file" class="form-control" @change="fileUpload($event, 'projeDocs2')" required>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12 pt-5 pb-5" v-if="form.rapor_pdf">
                            <div class="col-md-4">
                                <a :href="'/public/files/' + form.rapor_word" class="alert alert-success alert-dismissible " role="alert" download="">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Docs</strong>Yüklenen Raporu İndirmek İçin
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a :href="'/public/files/' + form.rapor_word2" class="alert alert-success alert-dismissible " role="alert" download="">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Docs</strong>Yüklenen Raporu İndirmek İçin
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a :href="'/public/files/' + form.rapor_pdf" class="alert alert-success alert-dismissible " role="alert" download="">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Docs</strong>Yüklenen Raporu İndirmek İçin
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12" v-if="form.durum == 'Rapor Red Edildi'">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Red Nedeni </label>
                                <textarea class="form-control" v-model="form.red_nedeni" rows="3" disabled></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary" @click="addRapor()">Kaydet</button>
                    <button type="button" class="btn btn-primary" disabled>Kaydet</button>

                </div>

            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg23 rapor_tezz" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tez Raporu *(doc/docx)</label>
                                    <input type="file" class="form-control" @change="fileUpload($event, 'tezDocs')">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tez Raporu *(pdf)</label>
                                    <input type="file" class="form-control" @change="fileUpload($event, 'tezPdf')">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tez Raporu *(doc/docx)</label>
                                    <input type="file" class="form-control" @change="fileUpload($event, 'tezDocs2')">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12 pt-5 pb-5" v-if="form.tez_pdf">
                            <div class="col-md-4">
                                <a :href="'/public/files/' + form.tez_word" class="alert alert-success alert-dismissible " role="alert" download="">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Docs</strong>Yüklenen Raporu İndirmek İçin
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a :href="'/public/files/' + form.tez_word2" class="alert alert-success alert-dismissible " role="alert" download="">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Docs</strong>Yüklenen Raporu İndirmek İçin
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a :href="'/public/files/' + form.tez_pdf" class="alert alert-success alert-dismissible " role="alert" download="">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Docs</strong>Yüklenen Raporu İndirmek İçin
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12" v-if="form.durum == 'Tez Red Edildi'">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Red Nedeni </label>
                                <textarea class="form-control" v-model="form.red_nedeni" rows="3" disabled></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary" @click="addTez()">Kaydet</button>
                    <button type="button" class="btn btn-primary" disabled>Kaydet</button>

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
            forms: [],
            o_forms: [],
            durum: '',
            search: '',
            editis: true,
            lenght_amac: '',
            lenght_metaryel: '',
            lenght_anahtar_kelime: '',
            edit_: true,
            form: {
                baslik: '',
                amac: '',
                anahtar_kelime: '',
                metaryel: '',
            },
            form2: {
                denem: ""
            }
        };
    },
    validations() {
        return {
            form: {
                baslik: { required: required },
                amac: { required },
                anahtar_kelime: { required },
                metaryel: { required, email },

            }

        }
    },

    methods: {
        removeT() {

        },
        load() {
            axios.post("/takip/proje-data").then((response) => {
                this.forms = response.data;
                this.durum = response.data[0].durum
                this.o_forms = response.data
            });
        },
        fileUpload(e, name) {
            this.$set(this.form, name, e.target.files[0]);
        },

        edit(index) {
            this.form = this.o_forms[index];
            this.editis = false;
            document.getElementById('modal2').click();
        },
        edit2(index) {
            if (this.durum == 'Devam Eden Proje') {
                errorModal('Başarısız', 'Proje Henüz Öneri aşamasını geçemediği için bu kısım aktif değil');

            } else {
                this.form = this.o_forms[index];
                this.editis = false;
                document.getElementById('rapor_tez').click();
            }

        },
        edit3(index) {
            if (this.durum == 'Devam Eden Proje' || this.durum.includes('Rapor')) {
                errorModal('İşlem Başarısız', 'Proje Henüz Tez Aşamasına Geçmedi')
            } else {
                  this.form = this.o_forms[index];
            this.editis = false;
            document.getElementById('rapor_tezz').click();
            }
          
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
        addRapor() {
            var formData = new FormData();

            formData.append('id', this.form.id);
            if (this.form.projeDocs) {
                formData.append('projeDocs', this.form.projeDocs, this.form.projeDocs.name);
            }
            if (this.form.projeDocs2) {
                formData.append('projeDocs2', this.form.projeDocs2, this.form.projeDocs2.name);
            }
            if (this.form.projePdf) {
                formData.append('projePdf', this.form.projePdf, this.form.projePdf.name);
            }

            axios.post('/takip/proje-rapor-add', formData)
                .then(response => {

                    successModal('Başarılı', 'İşlem Başarılı Proje Danışman Onayına Gönderildi.');
                    this.load();
                })
                .catch(err => {
                    errorModal('Başarısız', 'İşlem Başarısız');
                    console.log(err);
                })
        },
        addTez() {
            var formData = new FormData();

            formData.append('id', this.form.id);
            if (this.form.tezDocs) {
                formData.append('tezDocs', this.form.tezDocs, this.form.tezDocs.name);
            }
            if (this.form.tezDocs2) {
                formData.append('tezDocs2', this.form.tezDocs2, this.form.tezDocs2.name);
            }
            if (this.form.tezPdf) {
                formData.append('tezPdf', this.form.tezPdf, this.form.tezPdf.name);
            }

            axios.post('/takip/proje-tez-add', formData)
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
    watch: {
        'form.amac': function () {
            var k = this.form.amac;
            k = k.replace(/(^\s*) | (\s*$)/gi, "");
            k = k.replace(/[ ]{2,}/gi, " ");
            k = k.replace(/\n/, /"\n"/);
            return this.lenght_amac = k.split(' ').length;

        },
        'form.anahtar_kelime': function () {
            var k = this.form.anahtar_kelime;
            k = k.replace(/(^\s*) | (\s*$)/gi, "");
            k = k.replace(/[ ]{2,}/gi, " ");
            k = k.replace(/\n/, /"\n"/);
            return this.lenght_anahtar_kelime = k.split(' ').length;

        },
        'form.metaryel': function () {
            var k = this.form.metaryel;
            k = k.replace(/(^\s*) | (\s*$)/gi, "");
            k = k.replace(/[ ]{2,}/gi, " ");
            k = k.replace(/\n/, /"\n"/);
            return this.lenght_metaryel = k.split(' ').length;

        }
    }
};
</script>
