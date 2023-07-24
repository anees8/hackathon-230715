<template>
  <b-container fluid>
    <b-row>
      <b-card>
        <b-col>
          <b-row align-v="center">
            <b-col><h5>Tailors List</h5></b-col>
            <b-col>
              <b-button
              size="sm"
                @click="modal = !modal"
                class="float-end"
                pill
                variant="outline-dark"
              >
                <FontAwesomeIcon icon="plus" class="me-2" />Add Tailor</b-button
              >
              <div>
                <b-modal
                  v-model="modal"
                  :title="tailor.id ? 'Update Tailor' : 'Add Tailor'"
                  hide-header-close
                  no-close-on-backdrop
                >
                  <BFormGroup
                    id="input-group-1"
                    label="Tailor Name:"
                    label-for="input-1"
                  >
                    <BFormInput
                      id="input-1"
                      v-model="tailor.name"
                      :class="errors && errors.name ? 'is-invalid' : ''"
                      :disabled="!isBusy ? false : true"
                      type="text"
                      placeholder="Enter Tailor Name"
                    />
                    <BFormInvalidFeedback v-if="errors && errors.name">{{
                      errors.name[0]
                    }}</BFormInvalidFeedback>
                  </BFormGroup>

                  <BFormGroup
                    id="input-group-2"
                    label="Tailor Phone Number:"
                    label-for="input-2"
                  >
                    <BFormInput
                      id="input-2"
                      v-model="tailor.phone"
                      :class="errors && errors.phone ? 'is-invalid' : ''"
                      :disabled="!isBusy ? false : true"
                      type="number"
                      placeholder="Enter Tailor Phone Number"
                    />
                    <BFormInvalidFeedback v-if="errors && errors.phone">{{
                      errors.phone[0]
                    }}</BFormInvalidFeedback>
                  </BFormGroup>

                  <BFormGroup
                    id="input-group-3"
                    label="Tailor Email Address :"
                    label-for="input-3"
                  >
                    <BFormInput
                      id="input-3"
                      v-model="tailor.email"
                      :class="errors && errors.email ? 'is-invalid' : ''"
                      :disabled="!isBusy ? false : true"
                      type="email"
                      placeholder="Enter Tailor Email Address"
                    />
                    <BFormInvalidFeedback v-if="errors && errors.email">{{
                      errors.email[0]
                    }}</BFormInvalidFeedback>
                  </BFormGroup>
                  <BFormGroup
                    id="input-group-4"
                    label="Commission Limit / Day :"
                    label-for="input-4"
                  >
                    <BFormInput
                      id="input-4"
                      v-model="tailor.commission_limit"
                      :class="
                        errors && errors.commission_limit ? 'is-invalid' : ''
                      "
                      :disabled="!isBusy ? false : true"
                      type="number"
                      placeholder="Enter Commission Limit / Day"
                    />
                    <BFormInvalidFeedback
                      v-if="errors && errors.commission_limit"
                      >{{ errors.commission_limit[0] }}</BFormInvalidFeedback
                    >
                  </BFormGroup>

                  <BFormGroup
                    id="input-group-5"
                    label="Maximum Unit / Day :"
                    label-for="input-5"
                  >
                    <BFormInput
                      id="input-5"
                      v-model="tailor.max_units_per_day"
                      :class="
                        errors && errors.max_units_per_day ? 'is-invalid' : ''
                      "
                      :disabled="!isBusy ? false : true"
                      type="number"
                      placeholder="Enter Maximum Unit / Day"
                    />
                    <BFormInvalidFeedback
                      v-if="errors && errors.max_units_per_day"
                      >{{ errors.max_units_per_day[0] }}</BFormInvalidFeedback
                    >
                  </BFormGroup>

                  <BFormGroup
                    id="input-group-6"
                    label="Address :"
                    label-for="input-6"
                  >
                    <BFormTextarea
                      id="textarea-1"
                      v-model="tailor.address"
                      :class="errors && errors.address ? 'is-invalid' : ''"
                      :disabled="!isBusy ? false : true"
                      placeholder="Enter Address"
                    />
                    <BFormInvalidFeedback v-if="errors && errors.address">{{
                      errors.address[0]
                    }}</BFormInvalidFeedback>
                  </BFormGroup>
                  <template #footer>
                    <div>
                      <button class="btn btn-outline-dark" @click="hideModel">
                        Close
                      </button>
                    </div>
                    <div>
                      <button
                        class="btn btn-outline-primary"
                        @click="uploadData"
                      >
                        {{ tailor.id ? "Update Tailor" : "Add Tailor" }}
                      </button>
                    </div>
                  </template>
                </b-modal>
              </div></b-col
            >
          </b-row>
        </b-col>
        <b-col
          ><b-table
            striped
            outlined
            empty-filtered-text
            caption-top
            hover
            small
            footClone
            :items="tailors"
            :fields="fields"
            :busy="isBusy"
            responsive
            show-empty
          >
            <template #cell(product_types)="data">
            
              <ul>   
                <li
                  v-for="(product_type, index) in data.item.product_types"
                  :key="index"
                >
                  {{ product_type.name.toUpperCase() }}
                </li>
                
              </ul>
          
            </template>
            
            <template #cell(actions)="data">
          <RouterLink
          class="btn btn-outline-success me-2"
          :to="{
          name: 'tailoraccept',
          params: {
          id:data.item.id
          }
          }"
          >
          
          <FontAwesomeIcon icon="eye" />
        Accept  Orders
          </RouterLink>
          <RouterLink
          class="btn btn-outline-secondary me-2"
          :to="{
          name: 'tailorview',
          params: {
          id:data.item.id
          }
          }"
          >
          
          <FontAwesomeIcon icon="eye" />
          All Orders
      
          </RouterLink>
             
              <b-button
              size="sm"
                class="rounded-circle p-2 me-2"
                @click="editTailor(data.item.id)"
                variant="outline-success"
              >
                <FontAwesomeIcon icon="pen" />
              </b-button>

              <b-button
              size="sm"
                class="rounded-circle p-2 me-2"
                @click="deleteTailor(data.item.id)"
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
              v-on:click="getTailors"
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

import { useTailorsStore } from "../stores/tailors.js";

import { useProductTypesStore } from "../stores/productTypes";
const {
  productTypes
} = storeToRefs(useProductTypesStore());
const {
  getProductTypes,
} = useProductTypesStore();


const {
  selectedProductType,
  tailors,
  tailor,
  fields,
  modal,
  isBusy,
  errors,
  options,
  perPage,
  currentPage,
  rows
} = storeToRefs(useTailorsStore());



const {
  getTailors,
  setPerPage,
  uploadData,
  editTailor,
  deleteTailor,
  hideModel
} = useTailorsStore();


getProductTypes();
getTailors();
</script>
