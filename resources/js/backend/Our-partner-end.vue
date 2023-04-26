<template>
    <div>
        <v-main>
            <v-row class="ma-1 news-activitie">
                <!-- dialogInsert -->
                <v-dialog v-model="dialoginsert" width="auto">
                    <template v-slot:activator="{ props }">
                        <v-col cols="8" class="d-flex align-end">
                            <v-btn color="#D50703" class="text-white" v-bind="props"><i
                                    class="mdi mdi-text-box-plus-outline"></i>Insert
                            </v-btn>
                        </v-col>
                    </template>
                    <v-card>
                        <v-toolbar class="text-center text-white" color="#D50703"
                            title="INSERT INTO OUT PARTNER"></v-toolbar>
                        <v-card-text>
                            <v-container>
                                <v-row class="d-flex align-center">
                                    <v-col cols="12" sm="12" md="12">
                                        <v-text-field label="Name" color="#D50703" v-model="partner.name_partner"
                                            variant="outlined" required></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="12" md="12">
                                        <v-text-field label="Website" color="#D50703" v-model="partner.website_partner"
                                            variant="outlined" required></v-text-field>
                                    </v-col>
                                    <div class="ps-3">Front Cover</div>
                                    <v-col class="d-flex align-center fileinsert" cols="12" sm="12" md="12">
                                        <label for="myImage"><i class="mdi mdi-image-plus-outline"></i></label>
                                        <input type="file" id="myImage" accept="image/png, image/gif, image/jpeg" />
                                    </v-col>
                                    <v-divider class="border-opacity-90 mb-3"></v-divider>
                                    <div class="ps-3">Gallery Image</div>
                                    <v-col class="d-flex align-center fileinsert" cols="12" sm="12" md="12">
                                        <label for="myImage"><i class="mdi mdi-image-plus-outline"></i></label>
                                        <input type="file" id="myImage" accept="image/png, image/gif, image/jpeg" />
                                    </v-col>
                                    <v-divider class="border-opacity-90 "></v-divider>
                                    <v-col cols="12" class="text-center">
                                        <v-btn type="submit" color="#28A745" class="mx-1 text-white" width="100px"
                                            @click="dialoginsert = false, saveData()">
                                            Save
                                        </v-btn>
                                        <v-btn color="#D50703" class="mx-1 text-white" width="100px"
                                            @click="dialoginsert = false">
                                            Cancle
                                        </v-btn>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>

                    </v-card>
                </v-dialog>
                <!-- dialogInsert END -->
                <v-col cols="3"><v-text-field v-model="search" class="text-red" variant="underlined" label="Search"
                        single-line hide-details></v-text-field>
                </v-col>
                <v-col cols="1" class="d-flex align-end">
                    <i class="fa-solid fa-magnifying-glass iconsearch"></i>
                </v-col>
                <v-col cols="12">
                    <v-card>
                        <v-table>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Website</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in list_partners" :key="item.id">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.name_partner }}</td>
                                    <td>{{ item.website_partner }}</td>
                                    <td>
                                        <!-- dialogView -->
                                        <i class="fa-solid fa-eye ma-2 action-backend-view"
                                            @click="dialogview = true, infoData(item.id)"></i>
                                        <!-- dialogView END -->
                                        <!-- dialogEdit -->
                                        <i class="fa-solid fa-file-pen ma-2 action-backend-edit"
                                            @click="dialogedit = true, infoData(item.id)"></i>
                                        <!-- dialogEdit END -->
                                        <i class="fa-solid fa-trash ma-2 action-backend-delete"
                                            @click="deleteData(item.id)"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </v-table>
                    </v-card>
                </v-col>
            </v-row>
        </v-main>
        <!-- dialog view -->
        <v-dialog v-model="dialogview" width="auto">
            <v-card>
                <v-toolbar class="text-center text-white" color="#00D1FF" title="VIEW OUT PARTNER"></v-toolbar>
                <v-card-text>
                    <v-container>
                        <v-row class="d-flex align-center">
                            <!-- <v-col cols="2" class="dialogidunderline">
                                <v-list-subheader>ID : </v-list-subheader>
                            </v-col> -->
                            <v-col cols="1" sm="1" md="1">
                                <v-text-field label="ID" variant="underlined" v-model="updatepartner.id"
                                    readonly></v-text-field>
                            </v-col>
                            <v-col cols="11" sm="11" md="11">
                                <v-text-field label="Name" variant="underlined" v-model="updatepartner.name_partner"
                                    readonly></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="12">
                                <v-text-field label="Website" variant="underlined" v-model="updatepartner.website_partner"
                                    readonly></v-text-field>
                            </v-col>
                            <v-col cols="6" sm="6" md="6">
                                <v-text-field label="Date Create" variant="underlined" v-model="updatepartner.created_at"
                                    readonly></v-text-field>
                            </v-col>
                            <v-col cols="6" sm="6" md="6">
                                <v-text-field label="Date Update" variant="underlined" v-model="updatepartner.updated_at"
                                    readonly></v-text-field>
                            </v-col>
                            <div class="ps-3">Front Cover</div>
                            <v-col class="d-flex align-center fileinsert" cols="12" sm="12" md="12">
                                <img :src="app_url + '/images/01.jpg'" alt="">
                            </v-col>
                            <v-divider class="border-opacity-90 mb-3"></v-divider>
                            <div class="ps-3">Gallery Image</div>
                            <v-col class="d-flex align-center fileinsert" cols="12" sm="12" md="12">
                                <img :src="app_url + '/images/01.jpg'" alt="">
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
            </v-card>
        </v-dialog>
        <!-- dialog view END -->
        <!-- dialog edit -->
        <v-dialog v-model="dialogedit" width="auto">
            <v-card>
                <v-toolbar class="text-center text-white" color="#F9A825" title="EDIT OUT PARTNER"></v-toolbar>
                <v-card-text>
                    <v-container>
                        <v-row class="d-flex align-center">
                            <v-col cols="12" sm="12" md="12">
                                <v-text-field label="ID" variant="outlined" color="#F9A825" v-model="updatepartner.id"
                                required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="12">
                                <v-text-field label="Name" variant="outlined" color="#F9A825" v-model="updatepartner.name_partner" 
                                    required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="12">
                                <v-text-field label="Website" variant="outlined" color="#F9A825" v-model="updatepartner.website_partner"
                                    required></v-text-field>
                            </v-col>
                            <div class="ps-3">Front Cover</div>
                            <v-col class="d-flex align-center fileinsert" cols="12" sm="12" md="12">
                                <img :src="app_url + '/images/01.jpg'" alt="">
                                
                            </v-col>
                            <v-divider class="border-opacity-90 mb-3"></v-divider>
                            <div class="ps-3">Gallery Image</div>
                            <v-col class="d-flex align-center fileinsert" cols="12" sm="12" md="12">
                                <img :src="app_url + '/images/01.jpg'" class="me-1" alt="">
                                <label for="myImage" class="ms-1"><i class="mdi mdi-image-plus-outline"></i></label>
                                    <input type="file" id="myImage" accept="image/png, image/gif, image/jpeg" />
                            </v-col>
                            <v-col cols="12" class="text-center">
                                <v-btn type="submit" color="#28A745" class="mx-1 text-white" width="100px"
                                    @click="dialogedit = false,updateData(updatepartner.id)">
                                    Update
                                </v-btn>
                                <v-btn color="#D50703" class="mx-1 text-white" width="100px" @click="dialogedit = false">
                                    Cancle
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
            </v-card>
        </v-dialog>
        <!-- dialog edit END -->
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            dialoginsert: false,
            dialogview: false,
            dialogedit: false,
            'partner': {
                'name_partner': '',
                'website_partner': ''
            },
            'updatepartner': {
                // 'id': '',
                // 'name_partner': '',
                // 'website_partner': ''
            },
            list_partners: [],
            
        }
    },
    methods: {
        //insert
        saveData() {
            axios.post('/apipartner', this.partner)
            alert('Adding Data');

        },
        //view
        infoData($id) {
            axios.get('/apipartner/' + $id).then((response) => {
                console.log(response.data)
                this.updatepartner = response.data
            }).catch((error) => {
                console.log(error)
            });

        },
        updateData($id) {
            axios.put('/apipartner/' + $id,this.updatepartner)
            alert('Updating Data');
        },
        deleteData($id) {
            axios.delete('/apipartner/' + $id)
            alert('Delete Data');

        },
    },
    mounted() {
        //fetch data
        axios.get('/apipartner').then((response) => {
            console.log(response.data)
            this.list_partners = response.data
        }).catch((error) => {
            console.log(error)
        });
    }
}
</script>

<style></style>