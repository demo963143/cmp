<h1><i class="glyph-icon iconsminds-optimization"></i> <?=display('reports')?></h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="<?=base_url('repports/sales')?>" class="<?php if($this->uri->segment('2') =='sales') echo "btn-link";?>"><?=display('sales')?></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?=base_url('repports/expences')?>" class="<?php if($this->uri->segment('2') =='expences') echo "btn-link";?>"><?=display('expenses')?></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?=base_url('repports/clients')?>" class="<?php if($this->uri->segment('2') =='clients') echo "btn-link";?>"><?=display('customers')?></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?=base_url('repports/registers')?>" class="<?php if($this->uri->segment('2') =='registers') echo "btn-link";?>"><?=display('todaysale')?> </a>
                            </li>
                        </ol>
                    </nav>
                    <div class="separator mb-1"></div>