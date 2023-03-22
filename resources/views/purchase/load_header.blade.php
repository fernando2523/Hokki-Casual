 <!-- TOTAL STOCK -->
 <div class="col-xl-6 mb-6">
     <div class="card">
         <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
             <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                 <div class="mb-1 fw-bold">TOTAL PURCHASE ORDER</div>
                 <h4 class="text-theme">{{ $totalpo }}</h4>
             </div>
             <div class="opacity-5">
                 <i class="bi bi-tags-fill fa-3x"></i>
             </div>
         </div>

         <!-- card-arrow -->
         <div class="card-arrow">
             <div class="card-arrow-top-left"></div>
             <div class="card-arrow-top-right"></div>
             <div class="card-arrow-bottom-left"></div>
             <div class="card-arrow-bottom-right"></div>
         </div>
     </div>
 </div>
 <!-- END -->
 <div class="col-xl-6 mb-6">
     <div class="card">
         <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
             <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                 <div class="mb-1 fw-bold">CAPITAL AMOUNT</div>
                 <h4 class="text-theme">@currency($totalmodal)</h4>
             </div>
             <div class="opacity-5">
                 <i class="bi bi-cash-stack fa-3x"></i>
             </div>
         </div>

         <!-- card-arrow -->
         <div class="card-arrow">
             <div class="card-arrow-top-left"></div>
             <div class="card-arrow-top-right"></div>
             <div class="card-arrow-bottom-left"></div>
             <div class="card-arrow-bottom-right"></div>
         </div>
     </div>
 </div>
