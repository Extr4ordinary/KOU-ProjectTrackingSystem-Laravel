<template>
    <div class="row">
    <!-- v-if="user.unvan=='proje-ogrencisi'" -->
        <div class="col-md-12" v-if="user.unvan=='proje-ogrencisi'">
            <h4>Proje Durumu</h4>
            <div class="row">
                <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 " aria-disabled="">
                    <div :class="['tile-stats', durum == 'Devam Eden Proje' ? 'bg-success': 'bg-success' ,'text-light']">
                        <div class="icon"><i class="fa fa-question"></i></div>
                        <div class="count">1</div>

                        <h3>Konu Önermesi</h3>
                        <p>{{durum ? 'Proje Önerisi': 'Henüz Başlanmadı'}}</p>
                    </div>
                </div>
                <div class="animated flipInY col-lg-4 col-md-3 col-sm-6">
                    <div :class="['tile-stats', durum != 'Devam Eden Proje' ? 'bg-success': 'bg-dark' ,'text-light']">
                        <div class="icon"><i class="fa fa-file"></i></div>
                        <div class="count">2</div>

                        <h3>Raporlarştırma</h3>
                        <p>{{durum.includes('Rapor') || durum.includes('Tez')? 'Proje Tez"e donüşüm aşamasında': 'Henüz Başlanmadı'}}</p>
                    </div>
                </div>
                <div class="animated flipInY col-lg-4 col-md-3 col-sm-6">
                    <div :class="['tile-stats', durum.includes('Tez') ? 'bg-success': 'bg-dark' ,'text-light']">
                        <div class="icon">
                            <i class="glyphicon glyphicon-repeat"></i>
                        </div>
                        <div class="count">3</div>

                        <h3>Tez'e Dönüştürme</h3>
                        <p>{{durum.includes('Tez') ? 'Proje Tez"e donüşüm aşamasında': 'Henüz Başlanmadı'}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12" v-if="user.unvan=='sistem-yoneticisi'">
            <h4>Panel Kısayolları ( Yönetici için  )</h4>

            <div class="row">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6">
                    <div class="tile-stats">
                        <div class="icon" ><i class="fa fa-user-plus"></i></div>
                        <div class="count"  @click="goUsers()" style="cursor:pointer">{{users.length}}</div>
                        <h3>Kullanıcı</h3>
                        <p>Yeni Bir kullanıcı Eklemek için <i class="fa fa-user-plus"></i> iconuna Tıklayınız</p>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-user-plus"></i></div>
                        <div class="count"  @click="goDonem()" style="cursor:pointer">1</div>
                        <h3>Dönem Kayıtları</h3>
                        <p>Yeni Dönem İşlemi Başlatmak İçin Tıklayınız</p>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6">
                    <div class="tile-stats">
                        <div class="icon">
                            <i class="fa fa-bomb"></i>
                        </div>
                        <div class="count" @click="goDonem()" style="cursor:pointer">12</div>
                        <h3>Eşleştir</h3>
                        <p>Sistemde eklenmiş öğrenci ve öğretmenleri eşleştir.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12" v-if="user.unvan=='proje-yurutucusu'">
            <h4>Ödev Takip sistemi</h4>
            <div class="row">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 " aria-disabled="">
                    <div class="tile-stats bg-success text-light">
                        <div class="icon"><i class="fa fa-question"></i></div>
                        <div class="count">1</div>

                        <h3>Konu Önermesi</h3>
                        <p>Danışmanlığınız yaptığınız öğrencilerden konu önermesi yapanlar</p>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-file"></i></div>
                        <div class="count">1</div>

                        <h3>Raporlarştırma</h3>
                        <p>Danışmanlığınız yaptığınız öğrencilerden Raporlaştırma aşamasında </p>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6">
                    <div class="tile-stats">
                        <div class="icon">
                            <i class="glyphicon glyphicon-repeat"></i>
                        </div>
                        <div class="count">1</div>

                        <h3>Tez'e Dönüştürme</h3>
                        <p>Danışmanlığınız yaptığınız öğrencilerden Tez'e Dönme aşamasında </p>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6">
                    <div class="tile-stats">
                        <div class="icon">
                            <i class="fa fa-history"></i>
                        </div>
                        <div class="count">4</div>

                        <h3>Öğrenciler</h3>
                        <p>Danışmanlık yapıyor olduğunuz öğrencileri görüntüle</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            users : [],
            user : [],
            project : {},
            durum : '',
        }
    },
    methods:{
        goUsers(){
            window.open('/takip/users','blank');
        },
        goDonem(){
            window.open('/takip/donem','blank');
        },
         load() {
            axios.post("/takip/online-user-data").then((response) => {
                this.user = response.data.user;
                this.project = response.data.project;
                this.durum = response.data.project.durum;
            });
        },
        getUsers() {
            axios.post("/takip/user-data").then((response) => {
                this.users = response.data;
            });
        },
    },
    mounted(){
         this.load();
         this.getUsers();
    }
};
</script>
