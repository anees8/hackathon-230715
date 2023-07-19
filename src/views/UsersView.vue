<template>
   <b-container fluid>
    <b-row>
      <b-card>
        <b-col>
          <b-row align-v="center">
            <b-col><h5>Users List</h5></b-col>
            <b-col>
            <b-button
              @click="modal = !modal"
              class="float-end"
              pill
              variant="outline-dark"
            >
              <FontAwesomeIcon icon="plus" class="me-2" />Add User</b-button
            >
            <div>
              <b-modal
                v-model="modal"
                :title="user.id ? 'Update User' : 'Add User'"
              
                hide-header-close
                no-close-on-backdrop
              >
              <BFormGroup
                    id="input-group-1"
                    label="Your Name:"
                    label-for="input-1"
                  >
                    <BFormInput
                      id="input-1"
                      v-model="user.name"
                      :class="errors && errors.name ? 'is-invalid' : ''"
                      :disabled="!isBusy ? false : true"
                      type="text"
                      placeholder="Enter Your Name"
                    />
                    <BFormInvalidFeedback v-if="errors && errors.name">{{
                      errors.name[0]
                    }}</BFormInvalidFeedback>
                  </BFormGroup>
                  <BFormGroup
                    id="input-group-2"
                    label="Your Email Address:"
                    label-for="input-2"
                  >
                    <BFormInput
                      id="input-2"
                      v-model="user.email"
                      :class="errors && errors.email ? 'is-invalid' : ''"
                      :disabled="!isBusy ? false : true"
                      type="email"
                      placeholder="Enter Email Address"
                    />
                    <BFormInvalidFeedback v-if="errors && errors.email">{{
                      errors.email[0]
                    }}</BFormInvalidFeedback>
                  </BFormGroup>

                
                  
                  <BFormGroup
                    id="input-group-3"
                    label="Password :"
                    label-for="input-3"
                  >
                    <BFormInput
                      id="input-3"
                      v-model="user.password"
                      :class="errors && errors.password ? 'is-invalid' : ''"
                      :disabled="!isBusy ? false : true"
                      type="password"
                      placeholder="Enter Password"
                    />
                    <BFormInvalidFeedback v-if="errors && errors.password">{{
                      errors.password[0]
                    }}</BFormInvalidFeedback>
                  </BFormGroup>

                  <BFormGroup
                    id="input-group-4"
                    label="Confirm Password :"
                    label-for="input-4"
                  >
                    <BFormInput
                      id="input-4"
                      v-model="user.password_confirmation"
                      :class="errors && errors.password_confirmation ? 'is-invalid' : ''"
                      :disabled="!isBusy ? false : true"
                      type="password"
                      placeholder="Enter Confirm Password"
                    />
                    <BFormInvalidFeedback v-if="errors && errors.password_confirmation">{{
                      errors.password_confirmation[0]
                    }}</BFormInvalidFeedback>
                  </BFormGroup>
  


      <template #footer>
                  <div>
                    <button class="btn btn-outline-dark" @click="hideModel">Close</button>
                  </div>
                  <div>
                    <button class="btn btn-outline-primary" @click="uploadData">
                      {{ user.id ? "Update User" : "Add User" }}
                    </button>
                  </div>
                </template>

</b-modal></div></b-col>
          </b-row>
        </b-col>
        <b-col
          ><b-table
            striped
            outlined
            empty-filtered-text
            caption-top
            hover
            footClone
            :items="users"
            :fields="fields"
            :busy="isBusy"
            responsive
            show-empty
          >
            
            <template #cell(created_at)="data">{{ dateTime(data.value) }}</template>
            <template #cell(actions)="data"> 
              <b-button
              class="rounded-circle p-2 me-2"
              @click="editUser(data.item.id)"
              variant="outline-success"
            >
              <FontAwesomeIcon icon="pen" />
            </b-button>

            <b-button
              class="rounded-circle p-2 me-2"
              @click="deleteUser(data.item.id)"
              variant="outline-danger"
            >
              <FontAwesomeIcon icon="fa-regular fa-trash-alt" />
            </b-button>
            
            </template> </b-table
        ></b-col>
        <b-row align-h="end" class="mt-5">
          <b-col xl="1" lg="2" md="2" class="p-2">
            <b-form-select
              v-if="rows > 5"
              v-model="perPage"
              :options="options"
              size="md"
              v-on:change="setPerPage"
              varient="dark"
            ></b-form-select>
          </b-col>
          <b-col xl="5" lg="6" md="8" class="p-2">
            <b-pagination
              v-if="rows / perPage > 1"
              v-on:click="getUsers"
              v-model="currentPage"
              :total-rows="rows"
              :per-page="perPage"
            ></b-pagination>
          </b-col>
        </b-row>
      </b-card>
    </b-row>
  </b-container>
  </template>
  <script setup>
  import { storeToRefs } from "pinia";
  
  import { useUsersStore } from "./../stores/users.js";
  const {
    users,
    user,
    fields,
    options,
    perPage,
    currentPage,
    modal, 
    rows,
    errors,
    isBusy,
  } = storeToRefs(useUsersStore());
  
  const { getUsers, setPerPage, dateTime ,uploadData,editUser,deleteUser ,  resetForm,
  hideModel} = useUsersStore();
  
  getUsers();
  </script>
  