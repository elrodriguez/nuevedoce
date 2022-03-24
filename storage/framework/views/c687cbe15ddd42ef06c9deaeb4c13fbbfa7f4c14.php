<?php
    $note = $document->note;

    $establishment = json_decode($document->establishment);
    $customer = json_decode($document->customer);

    $district = \Illuminate\Support\Facades\DB::table('districts')->where('id',$establishment->district_id)->first();
    $province = \Illuminate\Support\Facades\DB::table('provinces')->where('id',$establishment->province_id)->first();
    $department = \Illuminate\Support\Facades\DB::table('departments')->where('id',$establishment->department_id)->first();

    $customer_district = \Illuminate\Support\Facades\DB::table('districts')->where('id',$customer->district_id)->first();
    $customer_province = \Illuminate\Support\Facades\DB::table('provinces')->where('id',$customer->province_id)->first();
    $customer_department = \Illuminate\Support\Facades\DB::table('departments')->where('id',$customer->department_id)->first();

    $series = ($note->affected_document) ? $note->affected_document->series : $note->data_affected_document->series;
    $document_type_id = ($note->affected_document) ? $note->affected_document->document_type_id : $note->data_affected_document->document_type_id;
    $number = ($note->affected_document) ? $note->affected_document->number : $note->data_affected_document->number;

?>
<?php echo '<?xml version="1.0" encoding="utf-8" standalone="no"?>'; ?>

<CreditNote xmlns="urn:oasis:names:specification:ubl:schema:xsd:CreditNote-2"
            xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
            xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
            xmlns:ds="http://www.w3.org/2000/09/xmldsig#"
            xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2">
    <ext:UBLExtensions>
        <ext:UBLExtension>
            <ext:ExtensionContent/>
        </ext:UBLExtension>
    </ext:UBLExtensions>
    <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
    <cbc:CustomizationID>2.0</cbc:CustomizationID>
    <cbc:ID><?php echo e($document->series); ?>-<?php echo e($document->number); ?></cbc:ID>
    <cbc:IssueDate><?php echo e($document->date_of_issue); ?></cbc:IssueDate>
    <cbc:IssueTime><?php echo e($document->time_of_issue); ?></cbc:IssueTime>
    <?php
        $legend = json_decode($document->legends);
    ?>
    
    <cbc:Note languageLocaleID="<?php echo e($legend->code); ?>"><![CDATA[<?php echo e($legend->value); ?>]]></cbc:Note>
    
    
    <cbc:DocumentCurrencyCode><?php echo e($document->currency_type_id); ?></cbc:DocumentCurrencyCode>
    <cac:DiscrepancyResponse>
        <cbc:ReferenceID><?php echo e($series.'-'.$number); ?></cbc:ReferenceID>
        <cbc:ResponseCode><?php echo e($note->note_type->code); ?></cbc:ResponseCode>
        <cbc:Description><?php echo e($note->note_description); ?></cbc:Description>
    </cac:DiscrepancyResponse>
    <?php if($document->purchase_order): ?>
    <cac:OrderReference>
        <cbc:ID><?php echo e($document->purchase_order); ?></cbc:ID>
    </cac:OrderReference>
    <?php endif; ?>
    <cac:BillingReference>
        <cac:InvoiceDocumentReference>
            <cbc:ID><?php echo e($series.'-'.$number); ?></cbc:ID>
            <cbc:DocumentTypeCode><?php echo e($document_type_id); ?></cbc:DocumentTypeCode>
        </cac:InvoiceDocumentReference>
    </cac:BillingReference>

    <?php if($document->guides): ?>
        <?php $__currentLoopData = $document->guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <cac:DespatchDocumentReference>
            <cbc:ID><?php echo e($guide->number); ?></cbc:ID>
            <cbc:DocumentTypeCode><?php echo e($guide->document_type_id); ?></cbc:DocumentTypeCode>
        </cac:DespatchDocumentReference>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php if($document->related): ?>
        <?php $__currentLoopData = $document->related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <cac:AdditionalDocumentReference>
            <cbc:ID><?php echo e($rel->number); ?></cbc:ID>
            <cbc:DocumentTypeCode><?php echo e($rel->document_type_id); ?></cbc:DocumentTypeCode>
        </cac:AdditionalDocumentReference>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    
    <cac:Signature>
        <cbc:ID><?php echo e(config('configuration.signature_uri')); ?></cbc:ID>
        <cbc:Note><?php echo e(config('configuration.signature_note')); ?></cbc:Note>
        <cac:SignatoryParty>
            <cac:PartyIdentification>
                <cbc:ID><?php echo e($company->number); ?></cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name><![CDATA[<?php echo e($company->tradename); ?>]]></cbc:Name>
            </cac:PartyName>
        </cac:SignatoryParty>
        <cac:DigitalSignatureAttachment>
            <cac:ExternalReference>
                <cbc:URI>#<?php echo e(config('configuration.signature_uri')); ?></cbc:URI>
            </cac:ExternalReference>
        </cac:DigitalSignatureAttachment>
    </cac:Signature>
    
    <cac:AccountingSupplierParty>
        <cac:Party>
            <cac:PartyIdentification>
                <cbc:ID schemeID="6"><?php echo e($company->number); ?></cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name><![CDATA[<?php echo e($company->tradename); ?>]]></cbc:Name>
            </cac:PartyName>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[<?php echo e($company->name); ?>]]></cbc:RegistrationName>
                <cac:RegistrationAddress>
                    <cbc:ID><?php echo e($establishment->district_id); ?></cbc:ID>
                    <cbc:AddressTypeCode><?php echo e(str_pad($establishment->id, 4, "0", STR_PAD_LEFT)); ?></cbc:AddressTypeCode>
                    <?php if($establishment->urbanization): ?>
                    <cbc:CitySubdivisionName><?php echo e($establishment->urbanization); ?></cbc:CitySubdivisionName>
                    <?php endif; ?>
                    <cbc:CityName><?php echo e($province->description); ?></cbc:CityName>
                    <cbc:CountrySubentity><?php echo e($department->description); ?></cbc:CountrySubentity>
                    <cbc:District><?php echo e($district->description); ?></cbc:District>
                    <?php if($establishment->address && $establishment->address !== '-'): ?>
                    <cac:AddressLine>
                        <cbc:Line><![CDATA[<?php echo e($establishment->address); ?>]]></cbc:Line>
                    </cac:AddressLine>
                    <?php endif; ?>
                    <cac:Country>
                        <cbc:IdentificationCode><?php echo e($establishment->country_id); ?></cbc:IdentificationCode>
                    </cac:Country>
                </cac:RegistrationAddress>
            </cac:PartyLegalEntity>
            <?php if($establishment->email || $establishment->phone): ?>
            <cac:Contact>
                <?php if($establishment->phone): ?>
                <cbc:Telephone><?php echo e($establishment->phone); ?></cbc:Telephone>
                <?php endif; ?>
                <?php if($establishment->email): ?>
                <cbc:ElectronicMail><?php echo e($establishment->email); ?></cbc:ElectronicMail>
                <?php endif; ?>
            </cac:Contact>
            <?php endif; ?>
        </cac:Party>
    </cac:AccountingSupplierParty>
    
    <cac:AccountingCustomerParty>
        <cac:Party>
            <cac:PartyIdentification>
                <cbc:ID schemeID="<?php echo e($customer->identity_document_type_id); ?>"><?php echo e($customer->number); ?></cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[<?php echo e($customer->full_name); ?>]]></cbc:RegistrationName>
                <?php if($customer->address && $customer->address !== '-'): ?>
                <cac:RegistrationAddress>
                    <?php if($customer->district_id): ?>
                    <cbc:ID><?php echo e($customer->district_id); ?></cbc:ID>
                    <?php endif; ?>
                    <cac:AddressLine>
                        <cbc:Line><![CDATA[<?php echo e($customer->address); ?>]]></cbc:Line>
                    </cac:AddressLine>
                    <cac:Country>
                        <cbc:IdentificationCode><?php echo e($customer->country_id); ?></cbc:IdentificationCode>
                    </cac:Country>
                </cac:RegistrationAddress>
                <?php endif; ?>
            </cac:PartyLegalEntity>
            <?php if($customer->email || $customer->telephone): ?>
            <cac:Contact>
                <?php if($customer->telephone): ?>
                <cbc:Telephone><?php echo e($customer->telephone); ?></cbc:Telephone>
                <?php endif; ?>
                <?php if($customer->email): ?>
                <cbc:ElectronicMail><?php echo e($customer->email); ?></cbc:ElectronicMail>
                <?php endif; ?>
            </cac:Contact>
            <?php endif; ?>
        </cac:Party>
    </cac:AccountingCustomerParty>
    
    <cac:TaxTotal>
        <cbc:TaxAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total_taxes); ?></cbc:TaxAmount>
        <?php if($document->total_isc > 0): ?>
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total_base_isc); ?></cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total_isc); ?></cbc:TaxAmount>
            <cac:TaxCategory>
                <cac:TaxScheme>
                    <cbc:ID>2000</cbc:ID>
                    <cbc:Name>ISC</cbc:Name>
                    <cbc:TaxTypeCode>EXC</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
        <?php endif; ?>
        <?php if($document->total_taxed > 0): ?>
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total_taxed); ?></cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total_igv); ?></cbc:TaxAmount>
            <cac:TaxCategory>
                <cac:TaxScheme>
                    <cbc:ID>1000</cbc:ID>
                    <cbc:Name>IGV</cbc:Name>
                    <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
        <?php endif; ?>
        <?php if($document->total_unaffected > 0): ?>
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total_unaffected); ?></cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="<?php echo e($document->currency_type_id); ?>">0</cbc:TaxAmount>
            <cac:TaxCategory>
                <cac:TaxScheme>
                    <cbc:ID>9998</cbc:ID>
                    <cbc:Name>INA</cbc:Name>
                    <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
        <?php endif; ?>
        <?php if($document->total_exonerated > 0): ?>
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total_exonerated); ?></cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="<?php echo e($document->currency_type_id); ?>">0</cbc:TaxAmount>
            <cac:TaxCategory>
                <cac:TaxScheme>
                    <cbc:ID>9997</cbc:ID>
                    <cbc:Name>EXO</cbc:Name>
                    <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
        <?php endif; ?>
        <?php if($document->total_free > 0): ?>
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total_free); ?></cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total_igv); ?></cbc:TaxAmount>
            <cac:TaxCategory>
                <cac:TaxScheme>
                    <cbc:ID>9996</cbc:ID>
                    <cbc:Name>GRA</cbc:Name>
                    <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
        <?php endif; ?>
        <?php if($document->total_exportation > 0): ?>
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total_exportation); ?></cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="<?php echo e($document->currency_type_id); ?>">0</cbc:TaxAmount>
            <cac:TaxCategory>
                <cac:TaxScheme>
                    <cbc:ID>9995</cbc:ID>
                    <cbc:Name>EXP</cbc:Name>
                    <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
        <?php endif; ?>
        <?php if($document->total_other_taxes > 0): ?>
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total_other_taxes); ?></cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total_base_other_taxes); ?></cbc:TaxAmount>
            <cac:TaxCategory>
                <cac:TaxScheme>
                    <cbc:ID>9999</cbc:ID>
                    <cbc:Name>OTROS</cbc:Name>
                    <cbc:TaxTypeCode>OTH</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
        <?php endif; ?>
        <?php if($document->total_plastic_bag_taxes > 0): ?> 
        <cac:TaxSubtotal>
            <cbc:TaxAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total_plastic_bag_taxes); ?></cbc:TaxAmount>
            <cac:TaxCategory>
                <cac:TaxScheme>
                    <cbc:ID>7152</cbc:ID>
                    <cbc:Name>ICBPER</cbc:Name>
                    <cbc:TaxTypeCode>OTH</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
        <?php endif; ?>
    </cac:TaxTotal>
    <cac:LegalMonetaryTotal>
        <cbc:LineExtensionAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total_value); ?></cbc:LineExtensionAmount>
        <cbc:TaxInclusiveAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total); ?></cbc:TaxInclusiveAmount>
        <?php if($document->total_charges > 0): ?>
        <cbc:ChargeTotalAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total_charges); ?></cbc:ChargeTotalAmount>
        <?php endif; ?>
        <cbc:PayableAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($document->total); ?></cbc:PayableAmount>
    </cac:LegalMonetaryTotal>
    
    <?php $__currentLoopData = $document->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $xitem = json_decode($row->item, true);
    ?>
    <cac:CreditNoteLine>
        <cbc:ID><?php echo e($loop->iteration); ?></cbc:ID>
        <cbc:CreditedQuantity unitCode="<?php echo e(json_decode($row->item, true)['unit_measure_id']); ?>"><?php echo e($row->quantity); ?></cbc:CreditedQuantity>
        <?php if($row->total_value > 0): ?>
        <cbc:LineExtensionAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($row->total_value); ?></cbc:LineExtensionAmount>
        <?php endif; ?>
        <cac:PricingReference>
            <cac:AlternativeConditionPrice>
                <cbc:PriceAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($row->unit_price); ?></cbc:PriceAmount>
                <cbc:PriceTypeCode><?php echo e($row->price_type_id); ?></cbc:PriceTypeCode>
            </cac:AlternativeConditionPrice>
        </cac:PricingReference>
        <cac:TaxTotal>
            <cbc:TaxAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($row->total_taxes); ?></cbc:TaxAmount>
            <?php if($row->total_isc > 0): ?>
            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($row->total_base_isc); ?></cbc:TaxableAmount>
                <cbc:TaxAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($row->total_isc); ?></cbc:TaxAmount>
                <cac:TaxCategory>
                    <cbc:Percent><?php echo e($row->percentage_isc); ?></cbc:Percent>
                    <cbc:TierRange><?php echo e($row->system_isc_type_id); ?></cbc:TierRange>
                    <cac:TaxScheme>
                        <cbc:ID>2000</cbc:ID>
                        <cbc:Name>ISC</cbc:Name>
                        <cbc:TaxTypeCode>EXC</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
            <?php endif; ?>
            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($row->total_base_igv); ?></cbc:TaxableAmount>
                <cbc:TaxAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($row->total_igv); ?></cbc:TaxAmount>
                <cac:TaxCategory>
                    <cbc:Percent><?php echo e($row->percentage_igv); ?></cbc:Percent>
                    <cbc:TaxExemptionReasonCode><?php echo e($row->affectation_igv_type_id); ?></cbc:TaxExemptionReasonCode>
                    <?php ($affectation = \App\CoreBilling\Templates\FunctionTribute::getByAffectation($row->affectation_igv_type_id)); ?>
                    <cac:TaxScheme>
                        <cbc:ID><?php echo e($affectation['id']); ?></cbc:ID>
                        <cbc:Name><?php echo e($affectation['name']); ?></cbc:Name>
                        <cbc:TaxTypeCode><?php echo e($affectation['code']); ?></cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
            <?php if($row->total_other_taxes > 0): ?>
            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($row->total_base_other_taxes); ?></cbc:TaxableAmount>
                <cbc:TaxAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($row->total_other_taxes); ?></cbc:TaxAmount>
                <cac:TaxCategory>
                    <cbc:Percent><?php echo e($row->percentage_other_taxes); ?></cbc:Percent>
                    <cac:TaxScheme>
                        <cbc:ID>9999</cbc:ID>
                        <cbc:Name>OTROS</cbc:Name>
                        <cbc:TaxTypeCode>OTH</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
            <?php endif; ?>
            <?php if($row->total_plastic_bag_taxes > 0): ?>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($row->total_plastic_bag_taxes); ?></cbc:TaxAmount>
                <cbc:BaseUnitMeasure unitCode="NIU"><?php echo e(round($row->quantity,0)); ?></cbc:BaseUnitMeasure>
                <cac:TaxCategory>
                    <cbc:PerUnitAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($row->item->amount_plastic_bag_taxes); ?></cbc:PerUnitAmount>
                    <cac:TaxScheme>
                        <cbc:ID>7152</cbc:ID>
                        <cbc:Name>ICBPER</cbc:Name>
                        <cbc:TaxTypeCode>OTH</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
            <?php endif; ?>
        </cac:TaxTotal>
        <cac:Item>
            <cbc:Description><![CDATA[<?php echo e($xitem['name']); ?>]]></cbc:Description>
            <?php if($xitem['internal_id']): ?>
            <cac:SellersItemIdentification>
                <cbc:ID><?php echo e($xitem['internal_id']); ?></cbc:ID>
            </cac:SellersItemIdentification>
            <?php endif; ?>
            <?php if($xitem['item_code']): ?>
            <cac:CommodityClassification>
                <cbc:ItemClassificationCode><?php echo e($xitem['item_code']); ?></cbc:ItemClassificationCode>
            </cac:CommodityClassification>
            <?php endif; ?>
            <?php if($xitem['item_code_gs1']): ?>
            <cac:StandardItemIdentification>
                <cbc:ID><?php echo e($xitem['item_code_gs1']); ?></cbc:ID>
            </cac:StandardItemIdentification>
            <?php endif; ?>
            <?php if($row->attributes): ?>
            <?php $__currentLoopData = $row->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <cac:AdditionalItemProperty>
                <cbc:Name><![CDATA[<?php echo e($attr->description); ?>]]></cbc:Name>
                <cbc:NameCode><?php echo e($attr->attribute_type_id); ?></cbc:NameCode>
                <?php if($attr->value): ?>
                <cbc:Value><?php echo e($attr->value); ?></cbc:Value>
                <?php endif; ?>
                <?php if($attr->start_date || $attr->end_date || $attr->duration): ?>
                <cac:UsabilityPeriod>
                    <?php if($attr->start_date): ?>
                    <cbc:StartDate><?php echo e($attr->start_date); ?></cbc:StartDate>
                    <?php endif; ?>
                    <?php if($attr->end_date): ?>
                    <cbc:EndDate><?php echo e($attr->end_date); ?></cbc:EndDate>
                    <?php endif; ?>
                    <?php if($attr->duration): ?>
                    <cbc:DurationMeasure unitCode="DAY"><?php echo e($attr->duration); ?></cbc:DurationMeasure>
                    <?php endif; ?>
                </cac:UsabilityPeriod>
                <?php endif; ?>
            </cac:AdditionalItemProperty>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </cac:Item>
        <cac:Price>
            <cbc:PriceAmount currencyID="<?php echo e($document->currency_type_id); ?>"><?php echo e($row->unit_value); ?></cbc:PriceAmount>
        </cac:Price>
    </cac:CreditNoteLine>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</CreditNote><?php /**PATH C:\laragon\www\nuevedoce\app\CoreBilling\Templates/xml/credit.blade.php ENDPATH**/ ?>