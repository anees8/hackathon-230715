import { defineStore } from "pinia";
import axios from "axios";
import moment from "moment";

export const useUsersStore = defineStore("usersStore", {
state: () => ({
                fields: [
                { key: "id", label: "ID" },
                { key: "name", label: "Name" },
                { key: "email", label: "Email" },
                { key: "created_at", label: "Created Date" },
                { key: "actions", label: "Action" },
                ],
                users: [],
                user:{},
                perPage: 5,
                currentPage: 1,
                isBusy: false,
                rows: null,
                modal: false,   
                options: [
                { value: 5, text: "5" },
                { value: 10, text: "10" },
                { value: 50, text: "50" },
                { value: 100, text: "100" },
                ],   
               
                
                
                errors: {},
    }),

actions: {
    async getUsers() {
                this.isBusy = true;
                try {
                let url = "users";
                if (this.perPage) {
                url += `?perPage=${this.perPage}`;
                }
                if (this.currentPage > 1) {
                url += `${this.perPage ? "&" : "?"}page=${
                this.currentPage
                }`;
                }
                const response = await axios.get(url);
                this.users = response.data.data.users.data;
                this.currentPage = response.data.data.users.current_page;
                this.rows = response.data.data.users.total;

                this.isBusy = false;
                } catch (error) {
                if (error.response) {
                this.errors = error.response.data.errors;
                }
                this.isBusy = false;
                }
    }, 

    editUser(id){
        this.user =this.users.find(user=>user.id==id);
        this.modal = !this.modal;

    },

    deleteUser(id){
        Swal.fire({
            title: 'Are you sure?',
            text:  "Do you want to Delete this User : " + id,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'No, cancel'
            }).then((result) => {
            if (result.isConfirmed) {

            let url = "users/";

            axios
            .delete(url + id)
            .then((res) => {
            this.getUsers();
            Swal.fire("Deleted!", "User has been deleted.", "success");
            })
            .catch((error) => {
            this.errors = error.response.data.errors;
            });
            }
            });



    },




    dateTime(value) {
         return moment(value).format("D-MMM-Y");
    },

            setPerPage(value) {
            this.perPage = value;
            this.currentPage = 1;
            this.getUsers();
            },
           

            resetForm(){
            this.errors = {};


            this.user={};
            this.loading = false;
            },
            hideModel(){
            this.modal = !this.modal;
             this.getUsers();
            this.resetForm();
            },

            async uploadData (){
            const formData = new FormData();
            let config={
            header:{ "content-type": "multipart/form-data",
            },
            };
            this.loading = true;
            let url = "users";
            if(this.user.name){
            formData.append('name',this.user.name);
            }

            if(this.user.email){
            formData.append('email',this.user.email);
            }
            if(this.user.password){
            formData.append('password',this.user.password);
            }
            if(this.user.password_confirmation){
            formData.append('password_confirmation',this.user.password_confirmation);
            }

                if(!this.user.id){

                try {

                const response = await axios.post(url,formData,config);
                
                this.hideModel();
                }catch (error) {

                if (error.response) {
                this.errors = error.response.data.errors;
                }
                this.loading = false;
                }

                }else{
                formData.append('_method','put');
                try {
                const response = await axios.post(url+'/'+this.user.id,formData,config);
               
                this.hideModel();
                }catch (error) {

                if (error.response) {
                this.errors = error.response.data.errors;
                }
                this.loading = false;
                }

                }


            },
            },
    });
