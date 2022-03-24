<?php
    //dd($company->number);
?>
<?php echo '<?xml version="1.0" encoding="utf-8" standalone="no"?>'; ?>

<SummaryDocuments
        xmlns="urn:sunat:names:specification:ubl:peru:schema:xsd:SummaryDocuments-1"
        xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
        xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
        xmlns:ds="http://www.w3.org/2000/09/xmldsig#"
        xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2"
        xmlns:sac="urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <ext:UBLExtensions>
        <ext:UBLExtension>
            <ext:ExtensionContent/>
        </ext:UBLExtension>
    </ext:UBLExtensions>
    <cbc:UBLVersionID>2.0</cbc:UBLVersionID>
    <cbc:CustomizationID>1.1</cbc:CustomizationID>
    <cbc:ID><?php echo e($document->identifier); ?></cbc:ID>
    <cbc:ReferenceDate><?php echo e($document->date_of_reference->format('Y-m-d')); ?></cbc:ReferenceDate>
    <cbc:IssueDate><?php echo e($document->date_of_issue->format('Y-m-d')); ?></cbc:IssueDate>
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
        <cbc:CustomerAssignedAccountID><?php echo e($company->number); ?></cbc:CustomerAssignedAccountID>
        <cbc:AdditionalAccountID>6</cbc:AdditionalAccountID>
        <cac:Party>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[<?php echo e($company->name); ?>]]></cbc:RegistrationName>
            </cac:PartyLegalEntity>
        </cac:Party>
    </cac:AccountingSupplierParty>
    <?php $__currentLoopData = $document->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
    <?php ($doc = $row->document); ?>
    <sac:SummaryDocumentsLine>
        <cbc:LineID><?php echo e($loop->iteration); ?></cbc:LineID>
        <cbc:DocumentTypeCode><?php echo e($doc->document_type_id); ?></cbc:DocumentTypeCode>
        <cbc:ID><?php echo e($doc->series); ?>-<?php echo e($doc->number); ?></cbc:ID>
        <cac:AccountingCustomerParty>
            <cbc:CustomerAssignedAccountID><?php echo e(json_decode($doc->customer)->number); ?></cbc:CustomerAssignedAccountID>
            <cbc:AdditionalAccountID><?php echo e(json_decode($doc->customer)->identity_document_type_id); ?></cbc:AdditionalAccountID>
        </cac:AccountingCustomerParty>
        <?php if(in_array($doc->document_type_id, ['07', '08'])): ?>
        <?php ($affected_document = ($doc->note->affected_document) ? $doc->note->affected_document : $doc->note->data_affected_document); ?>
        <cac:BillingReference>
            <cac:InvoiceDocumentReference>
                <cbc:ID><?php echo e($affected_document->series); ?>-<?php echo e($affected_document->number); ?></cbc:ID>
                <cbc:DocumentTypeCode><?php echo e($affected_document->document_type_id); ?></cbc:DocumentTypeCode>
            </cac:InvoiceDocumentReference>
        </cac:BillingReference>
        <?php endif; ?>
        <?php if($doc->perception): ?>
        <?php ($perception = $doc->perception); ?>
        <sac:SUNATPerceptionSummaryDocumentReference>
            <sac:SUNATPerceptionSystemCode><?php echo e($perception->code); ?></sac:SUNATPerceptionSystemCode>
            <sac:SUNATPerceptionPercent><?php echo e($perception->percentage); ?></sac:SUNATPerceptionPercent>
            <cbc:TotalInvoiceAmount currencyID="PEN"><?php echo e($perception->amount); ?></cbc:TotalInvoiceAmount>
            <sac:SUNATTotalCashed currencyID="PEN"><?php echo e(round((float)$perception->base + (float)$perception->amount, 2)); ?></sac:SUNATTotalCashed>
            <cbc:TaxableAmount currencyID="PEN"><?php echo e($perception->base); ?></cbc:TaxableAmount>
        </sac:SUNATPerceptionSummaryDocumentReference>
        <?php endif; ?>
        <cac:Status>
            <cbc:ConditionCode><?php echo e($document->summary_status_type_id); ?></cbc:ConditionCode>
        </cac:Status>
        <sac:TotalAmount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total); ?></sac:TotalAmount>
        <?php if($doc->total_taxed > 0): ?>
        <sac:BillingPayment>
            <cbc:PaidAmount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total_taxed); ?></cbc:PaidAmount>
            <cbc:InstructionID>01</cbc:InstructionID>
        </sac:BillingPayment>
        <?php endif; ?>
        <?php if($doc->total_exonerated > 0): ?>
        <sac:BillingPayment>
            <cbc:PaidAmount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total_exonerated); ?></cbc:PaidAmount>
            <cbc:InstructionID>02</cbc:InstructionID>
        </sac:BillingPayment>
        <?php endif; ?>
        <?php if($doc->total_unaffected > 0): ?>
        <sac:BillingPayment>
            <cbc:PaidAmount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total_unaffected); ?></cbc:PaidAmount>
            <cbc:InstructionID>03</cbc:InstructionID>
        </sac:BillingPayment>
        <?php endif; ?>
        <?php if($doc->total_exportation > 0): ?>
        <sac:BillingPayment>
            <cbc:PaidAmount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total_exportation); ?></cbc:PaidAmount>
            <cbc:InstructionID>04</cbc:InstructionID>
        </sac:BillingPayment>
        <?php endif; ?>
        <?php if($doc->total_free > 0): ?>
        <sac:BillingPayment>
            <cbc:PaidAmount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total_free); ?></cbc:PaidAmount>
            <cbc:InstructionID>05</cbc:InstructionID>
        </sac:BillingPayment>
        <?php endif; ?>
        <?php if($doc->total_charges > 0): ?>
        <cac:AllowanceCharge>
            <cbc:ChargeIndicator>true</cbc:ChargeIndicator>
            <cbc:Amount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total_charges); ?></cbc:Amount>
        </cac:AllowanceCharge>
        <?php endif; ?>
        <?php if($doc->total_ivap > 0): ?>
        <cac:TaxTotal>
            <cbc:TaxAmount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total_ivap); ?></cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total_ivap); ?></cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>1016</cbc:ID>
                        <cbc:Name>IVAP</cbc:Name>
                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        <?php endif; ?>
        <cac:TaxTotal>
            <cbc:TaxAmount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total_igv); ?></cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total_igv); ?></cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>1000</cbc:ID>
                        <cbc:Name>IGV</cbc:Name>
                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        <?php if($doc->total_isc > 0): ?>
        <cac:TaxTotal>
            <cbc:TaxAmount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total_isc); ?></cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total_isc); ?></cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>2000</cbc:ID>
                        <cbc:Name>ISC</cbc:Name>
                        <cbc:TaxTypeCode>EXC</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        <?php endif; ?>
        <?php if($doc->total_other_taxes > 0): ?>
        <cac:TaxTotal>
            <cbc:TaxAmount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total_other_taxes); ?></cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total_other_taxes); ?></cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>9999</cbc:ID>
                        <cbc:Name>OTROS</cbc:Name>
                        <cbc:TaxTypeCode>OTH</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        <?php endif; ?>
        <?php if($doc->total_plastic_bag_taxes > 0): ?>
        <cac:TaxTotal>
            <cbc:TaxAmount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total_plastic_bag_taxes); ?></cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID="<?php echo e($doc->currency_type_id); ?>"><?php echo e($doc->total_plastic_bag_taxes); ?></cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>7152</cbc:ID>
                        <cbc:Name>ICBPER</cbc:Name>
                        <cbc:TaxTypeCode>OTH</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        <?php endif; ?>
    </sac:SummaryDocumentsLine>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</SummaryDocuments><?php /**PATH C:\laragon\www\nuevedoce\app\CoreBilling\Templates/xml/summary.blade.php ENDPATH**/ ?>