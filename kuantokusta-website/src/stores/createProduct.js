// import { defineStore } from "pinia";
// import axios from "axios";


// export const useCreateProductStore = defineStore("createProduct", {
//     state: () => ({
       
//     }),
//     getters: {
     
//     },
//     actions: {

//         async submitForm(data) {
//             try {
//                 console.log(data); // Logging the data received from the form
//                 const formData = new FormData();
//                 formData.append('name', data.name);
//                 formData.append('price', data.price);
//                 formData.append('brand', data.brand);
//                 formData.append('image', data.image);
        
//                 console.log(formData); // Logging the formData object just before sending
        
//                 const response = await axios.post("api/product", formData, {
//                     headers: {
//                         'Content-Type': 'multipart/form-data'
//                     }
//                 });
        
//                 this.successMessage = "Product created successfully!";
//                 console.log(response.data);
//             } catch (error) {
//                 this.errorMessage = "Failed to create product";
//                 console.error(error);
//             }
//         },
       
     
         
//         },
//       });