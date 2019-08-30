<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "invoice_bank".
 *
 * @property int $invoiceId
 * @property string $invoiceNim
 * @property string $invoiceNama
 * @property string $invoiceProdiKode
 * @property int $invoiceJnsBiayaId
 * @property string $invoiceUraian
 * @property double $invoiceJumlah
 * @property string $invoiceBankId
 * @property string $invoiceBuktiBayar
 * @property string $invoiceTglBayar
 * @property string $invoiceTglReversal
 * @property string $invoiceFlag
 * @property int $invoicePeriodeId
 * @property string $invoiceCreate
 *
 * @property RefBank $invoiceBank
 * @property RefJenisBiaya $invoiceJnsBiaya
 * @property WisudaUser $invoiceNim0
 * @property WisudaPeriode $invoicePeriode
 */
class InvoiceBank extends \yii\db\ActiveRecord {
    
    public $bankNama;
    public $bankKode;
    public $bankKodeVA;
    public $periodeNama;
    public $periodeTahun;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'invoice_bank';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['invoiceNim', 'invoiceNama','invoiceProdiKode', 'invoiceJnsBiayaId', 'invoiceUraian', 'invoiceJumlah', 'invoiceBankId', 'invoicePeriodeId', 'invoiceCreate'], 'safe'],
                [['invoiceJnsBiayaId', 'invoicePeriodeId'], 'integer'],
                [['invoiceJumlah'], 'number'],
                [['invoiceTglBayar', 'invoiceTglReversal', 'invoiceCreate'], 'safe'],
                [['invoiceFlag'], 'string'],
                [['invoiceNim', 'invoiceBankId'], 'string', 'max' => 15],
                [['invoiceNama', 'invoiceUraian', 'invoiceBuktiBayar'], 'string', 'max' => 250],
                [['invoiceBankId'], 'exist', 'skipOnError' => true, 'targetClass' => RefBank::className(), 'targetAttribute' => ['invoiceBankId' => 'bankId']],
                [['invoiceJnsBiayaId'], 'exist', 'skipOnError' => true, 'targetClass' => RefJenisBiaya::className(), 'targetAttribute' => ['invoiceJnsBiayaId' => 'jnsBiayaId']],
                [['invoiceNim'], 'exist', 'skipOnError' => true, 'targetClass' => WisudaUser::className(), 'targetAttribute' => ['invoiceNim' => 'wuNim']],
                [['invoicePeriodeId'], 'exist', 'skipOnError' => true, 'targetClass' => WisudaPeriode::className(), 'targetAttribute' => ['invoicePeriodeId' => 'wpId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'invoiceId' => 'Invoice ID',
            'invoiceNim' => 'Invoice Nim',
            'invoiceNama' => 'Invoice Nama',
            'invoiceProdiKode'=>'Invoice Prodi Kode',
            'invoiceJnsBiayaId' => 'Invoice Jns Biaya ID',
            'invoiceUraian' => 'Invoice Uraian',
            'invoiceJumlah' => 'Invoice Jumlah',
            'invoiceBankId' => 'Invoice Bank ID',
            'invoiceBuktiBayar' => 'Invoice Bukti Bayar',
            'invoiceTglBayar' => 'Invoice Tgl Bayar',
            'invoiceTglReversal' => 'Invoice Tgl Reversal',
            'invoiceFlag' => 'Invoice Flag',
            'invoicePeriodeId' => 'Invoice Periode ID',
            'invoiceCreate' => 'Invoice Create',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceBank() {
        return $this->hasOne(RefBank::className(), ['bankId' => 'invoiceBankId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceJnsBiaya() {
        return $this->hasOne(RefJenisBiaya::className(), ['jnsBiayaId' => 'invoiceJnsBiayaId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceNim0() {
        return $this->hasOne(WisudaUser::className(), ['wuNim' => 'invoiceNim']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicePeriode() {
        return $this->hasOne(WisudaPeriode::className(), ['wpId' => 'invoicePeriodeId']);
    }

}
