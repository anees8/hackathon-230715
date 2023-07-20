<script setup>
import { storeToRefs } from "pinia";

import { useProductTypesStore } from "../stores/productTypes";
const {
  productTypes,
  productType,
  fields,
  modal,
  isBusy,
  errors,
  options,
  perPage,
  currentPage,
  rows
} = storeToRefs(useProductTypesStore());

const {
  getProductTypes,
  dateTime,
  setPerPage,
  uploadData,
  editProductType,
  deleteProductType,
  hideModel
} = useProductTypesStore();

getProductTypes();
</script>
<template>
  <b-container fluid>
    <b-row>
      <b-card>
        <b-col>
          <b-row align-v="center">
            <b-col><h5>Product Type List</h5></b-col>
            <b-col>
              <b-button
                @click="modal = !modal"
                class="float-end"
                pill
                variant="outline-dark"
              >
                <FontAwesomeIcon icon="plus" class="me-2" />Add Product
                Type</b-button
              >
              <div>
                <b-modal
                  v-model="modal"
                  :title="
                    productType.id ? 'Update Product Type' : 'Add Product Type'
                  "
                  hide-header-close
                  no-close-on-backdrop
                >
                  <BFormGroup
                    id="input-group-1"
                    label="Product Type Name:"
                    label-for="input-1"
                  >
                    <BFormInput
                      id="input-1"
                      v-model="productType.name"
                      :class="errors && errors.name ? 'is-invalid' : ''"
                      :disabled="!isBusy ? false : true"
                      type="text"
                      placeholder="Enter Product Type Name"
                    />
                    <BFormInvalidFeedback v-if="errors && errors.name">{{
                      errors.name[0]
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
                        {{
                          productType.id
                            ? "Update Product Type"
                            : "Add Product Type"
                        }}
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
            footClone
            :items="productTypes"
            :fields="fields"
            :busy="isBusy"
            responsive
            show-empty
          >
            <template #cell(created_at)="data">{{
              dateTime(data.value)
            }}</template>
            <template #cell(actions)="data">
              <b-button
                class="rounded-circle p-2 me-2"
                @click="editProductType(data.item.id)"
                variant="outline-success"
              >
                <FontAwesomeIcon icon="pen" />
              </b-button>

              <b-button
                class="rounded-circle p-2 me-2"
                @click="deleteProductType(data.item.id)"
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
              v-on:click="getProductTypes"
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
