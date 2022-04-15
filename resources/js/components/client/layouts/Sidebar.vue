<template>
    <div>
       <div class="modal fade bs-example-modal-lg rapor_tez1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Danışman Hoca</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="col-md-12 pt-5 pb-5">
                            <div class="col-md-4">
                                <a class="alert alert-success alert-dismissible " role="alert" download="">
                                    <strong>{{danisman.ad + ' ' + danisman.soyad}}</strong>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a class="alert alert-success alert-dismissible " role="alert" download="">
                                    <strong>{{danisman.eposta}}</strong>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                </div>

            </div>
        </div>
    </div>
        <div class="col-md-3 left_col" style="background: #1c1f33 !important">
            <div
                class="left_col scroll-view"
                style="background: #1c1f33 !important"
            >
                <div
                    class="navbar nav_title"
                    style="border: 0; background: #1c1f33 !important"
                >
                   <!-- <a href="/" class="site_title"
                        ><i class="fa fa-renren"></i
                        ><span class="pl-3">Ödev Takip Sistemi</span></a
                    >-->
                    <div class="logooo"></div>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                         <i class="fa fa-paw img-circle profile_img" style="font-size:50px; color: #fff; background: #1C1F33"></i>

                    </div>
                    <div class="profile_info">
                        <span>Hoşgeldin,</span>
                        <h2>{{ user.ad + " " + user.soyad }}</h2>
                    </div>
                </div>

                <br />

                <!-- sidebar menu -->
                <div
                    id="sidebar-menu"
                    class="main_menu_side hidden-print main_menu"
                >
                    <div class="menu_section" v-if="user.unvan == 'sistem-yoneticisi'">
                        <h3>
                            Sistem Yöneticisi
                        </h3>
                        <ul class="nav side-menu">
                            <li>
                                <a href="/takip"
                                    ><i class="fa fa-home"></i> Anasayfa
                                </a>
                            </li>
                            <li>
                                <a href="/takip/users"
                                    ><i class="fa fa-home"></i> Kullanıcılar
                                </a>
                            </li>
                            <li>
                                <a href="/takip/donem"
                                    ><i class="fa fa-home"></i> Dönem Bilgisi 
                                </a>
                            </li>
                            <li>
                                <a href="/takip/ogrenciler"
                                    ><i class="fa fa-home"></i> Ödev Takibi
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="menu_section" v-if="user.unvan == 'proje-ogrencisi'">
                        <h3 >
                            Proje Öğrencisi
                        </h3>
                        <ul class="nav side-menu">
                            <li>
                                <a href="/takip"
                                    ><i class="fa fa-home"></i> Anasayfa
                                </a>
                            </li>
                            <li>
                                <a data-toggle="modal" data-target=".rapor_tez1"
                                    ><i class="fa fa-home"></i> Danışman Hoca
                                </a>
                            </li>
                            <li>
                                <a href="/takip/proje"
                                    ><i class="fa fa-home"></i> Ödev Takibi 
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="menu_section"  v-if="user.unvan == 'proje-yurutucusu'">
                       
                        <h3>
                            Proje Yürütücüsü
                        </h3>

                        <ul class="nav side-menu">
                            <li>
                                <a href="/takip"
                                    ><i class="fa fa-home"></i> Anasayfa
                                </a>
                            </li>
                            <li>
                                <a href="/takip/ogrenciler"
                                    ><i class="fa fa-home"></i> Öğrenciler ve Ödev Takibi
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div
                    class="sidebar-footer hidden-small"
                    style="background: #1c1f33 !important"
                >
                    <a
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Settings"
                        style="background-color: #1c1f33"
                    >
                        <span
                            class="glyphicon glyphicon-cog"
                            aria-hidden="true"
                        ></span>
                    </a>
                    <a
                        data-toggle="tooltip"
                        data-placement="top"
                        title="FullScreen"
                        style="background-color: #1c1f33"
                    >
                        <span
                            class="glyphicon glyphicon-fullscreen"
                            aria-hidden="true"
                        ></span>
                    </a>
                    <a
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Lock"
                        style="background-color: #1c1f33"
                    >
                        <span
                            class="glyphicon glyphicon-eye-close"
                            aria-hidden="true"
                        ></span>
                    </a>
                    <a
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Logout"
                        href=""
                        class="bg-warning"
                    >
                        <span
                            class="glyphicon glyphicon-off"
                            aria-hidden="true"
                        ></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                    <ul class="navbar-right">
                        <li
                            class="nav-item dropdown open"
                            style="padding-left: 15px"
                        >
                            <a
                                href="javascript:;"
                                class="user-profile dropdown-toggle"
                                aria-haspopup="true"
                                id="navbarDropdown"
                                data-toggle="dropdown"
                                aria-expanded="false"
                            >
                            <i class="fa fa-paw"></i>
                                {{ user.ad + " " + user.soyad }}
                            </a>
                            <div
                                class="dropdown-menu dropdown-usermenu pull-right"
                                aria-labelledby="navbarDropdown"
                            >
                                <a class="dropdown-item" href="/takip/logout"
                                    ><i class="fa fa-sign-out pull-right"></i>
                                    Çıkış Yap</a
                                >
                            </div>
                        </li>

                        <li
                            role="presentation"
                            class="nav-item dropdown open"
                        ></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
        
    </div>
    

</template>
<script>
export default {
    data() {
        return {
            user: [],
            danisman: [],
        };
    },
    methods: {
        load() {
            axios.post("/takip/online-user-data").then((response) => {
                this.user = response.data.user;
                this.danisman = response.data.danisman;
            });
        },
    },
    mounted() {
        this.load();
    },
};
</script>
