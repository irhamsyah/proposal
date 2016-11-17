<?php

class ProposalController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

        public function index()
	{
            //get ALL table proposal
            //$proposal= Proposal::where('create_date','=',date('Y-m-d'))->get();
            //$proposal= Proposal::where('tgl_masuk_proposal','>','date()-DAY(date())')->get();
            $proposal= Proposal::all();
            $realisasi=  Proposal::where('plafond_real','>','0')->get();
            $tdksetuju=  Proposal::where('persetujuan','=','Tidak Disetujui')->get();
            $setujuibelumcair=  Proposal::where('persetujuan','=','Disetujui')
                                ->where('plafond_real','=','0')->get();
            //load the view and pass table proposal:
            //return View::make('application.index')->with('proposal',$proposal);            
            
            //ket:
            //with('proposal',$proposal);
            //ket : 'proposal'-> adalah nama Variabel penampung data dari variabel $proposal,
            //yang akan dibuang ke index.blade.php sebagai penampil data
            //View::make('application.index')
            //'application'->nama folder tempat WEB DESIGN anda/template anda/form input anda :)
            
              if (Request::ajax()) {
            return Response::json(View::make('tampilan1',array('tampungan'=>$proposal))->render());
        }

            
            return View::make('aplikasi.register',array('tampungan'=>$proposal,'realisasi'=>$realisasi,'tdksetuju'=>$tdksetuju,'setujuibelumcair'=>$setujuibelumcair));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            $proposal= Proposal::all();
            return View::make('aplikasi.register')->with('tampungan',$proposal);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            //Proses Validasi Inputan
            $rules=array(
                'tanggalprop'=>'required',
                'unit'=>'required',
                'no_prop'=>'required|min:3|max:55',
                'produk'=>'required',
                'nama_debitur'=>'required',
                'plf_pengajuan'=>'required',
                'jns_pinj'=>'required',
                'plf_real'=>'required',
               
            );
            
            $validator=Validator::make(Input::all(),$rules);

            
            //
            $xx=0;
            $checking=  Proposal::where('nomor_proposal','=',Input::get('no_prop'))->get();
            foreach($checking as $kunci=>$nilas){
                $xx=count($nilas->nomor_proposal);
            }
            if($xx>0){
                Session::flash('message', '<H1>DATA NOMOR PROPOSAL INI SUDAH ADA !!</H1>');
                return Redirect::to('aplikasi')->withErrors($validator)->withInput();
                    
            }else{
            //process login
            if($validator->fails()){
                return Redirect::to('aplikasi.register')->withErrors($validator)->withInput();
            }else{
                $simpan=new Proposal;
                
                //berikut cara mengambil nilai dari inputan tanggal agar bisa disimpan 
                //myslq menggunakan format : yyyy-mm-dd : 2013-12-27
                //jika diambil dari <input type="text" name="tanggalprop"></input>, maka pake rumus :
                //substr(Input::get('tanggalprop'), 6, 4)."-".substr(Input::get('tanggalprop'), 0, 2)."-".  substr(Input::get('tanggalprop'), 3, 2);
                //jadinya : 2013-12-12
                //$simpan->tgl_masuk_proposal=substr(Input::get('tanggalprop'), 6, 4)."-".substr(Input::get('tanggalprop'), 0, 2)."-".  substr(Input::get('tanggalprop'), 3, 2);
                $simpan->tgl_masuk_proposal=date('Y-m-d',  strtotime(Input::get('tanggalprop')));
                $simpan->unit=Input::get('unit');
                $simpan->nomor_proposal=Input::get('no_prop');
                $simpan->produk=Input::get('produk');
                $simpan->nama_debitur=Input::get('nama_debitur');
                $simpan->plafond_pengajuan=Input::get('plf_pengajuan');
                $simpan->fasilitas=Input::get('jns_pinj');
                if(Input::get('tgl_krm_unit')=='0' or Input::get('tgl_krm_unit')==NULL){
                    $simpan->tgl_kirim_unit=NULL;
                }else{
                $simpan->tgl_kirim_unit=date('Y-m-d',  strtotime(Input::get('tgl_krm_unit')));}
                if(Input::get('tgl_krm_kp')=='0' or Input::get('tgl_krm_kp')==NULL){
                    $simpan->tgl_kirim_kp=NULL;
                }else{
                $simpan->tgl_kirim_kp=date('Y-m-d',  strtotime(Input::get('tgl_krm_kp')));}
                $simpan->bwmpkacab=Input::get('bwmpcab');
                $simpan->bwmpkp=Input::get('bwmpkp');
                if(Input::get('tgl_real')=='0' or Input::get('tgl_real')==NULL or Input::get('tgl_real')==""){
                    $simpan->tgl_realisasi=NULL;
                }else{
                $simpan->tgl_realisasi=date('Y-m-d',  strtotime(Input::get('tgl_real')));}
                $simpan->plafond_real=Input::get('plf_real');
                $simpan->keterangan=Input::get('ket');
                $simpan->nomor_proposal_lain=str_replace('/', '-', Input::get('no_prop'));
                $simpan->persetujuan=Input::get('statuspersetujuan');
                $simpan->create_date=date("Y-m-d H:i:s"); 
                $simpan->update_date=date("Y-m-d H:i:s"); 
                $simpan->save();
                Session::flash('message', 'DATA BERHASIL DISIMPAN!');
                return Redirect::to('aplikasi');
        } }}
        

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

            $dataedit=  Proposal::where('nomor_proposal_lain','=',$id)->take(10)->get();
            return View::make('aplikasi/edit')->with('dataedit',$dataedit);
                
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
        
        
	public function edit($id)
	{

         } 
     

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{   
            $tglkirimunit=NULL;$tglkirimKP=NULL;$tglrealisasi=NULL;
            if(Input::get('tgl_kirim_unit')=='0' or Input::get('tgl_kirim_unit')==NULL){
                $tglkirimunit=NULL;
            }  else {
                $tglkirimunit=date('Y-m-d',  strtotime(Input::get('tgl_kirim_unit')));
            }
            if(Input::get('tgl_kirim_kp')=='0' or Input::get('tgl_kirim_kp')==NULL){
                $tglkirimKP=NULL;
            }else{
                $tglkirimKP=date('Y-m-d',  strtotime(Input::get('tgl_kirim_kp')));
            }
             if(Input::get('tgl_realisasi')=='0' or Input::get('tgl_realisasi')==NULL){
                 $tglrealisasi=NULL;
             }else{
                 $tglrealisasi=date('Y-m-d',  strtotime(Input::get('tgl_realisasi')));
             }
            $simpan=array(
                'tgl_masuk_proposal'=>date('Y-m-d',  strtotime(Input::get('tgl_masuk_proposal'))),//substr(Input::get('tgl_masuk_proposal'), 6, 4)."-".substr(Input::get('tgl_masuk_proposal'), 0, 2)."-".  substr(Input::get('tgl_masuk_proposal'), 3, 2),
                'unit'=>Input::get('unit'),
                //'nomor_proposal'=>Input::get('nomor_proposal'),
                'produk'=>Input::get('produk'),
                'nama_debitur'=>Input::get('nama_debitur'),
                'plafond_pengajuan'=>Input::get('plafond_pengajuan'),
                'fasilitas'=>Input::get('fasilitas'),
                'tgl_kirim_unit'=>$tglkirimunit,//substr(Input::get('tgl_kirim_unit'), 6, 4)."-".substr(Input::get('tgl_kirim_unit'), 0, 2)."-".  substr(Input::get('tgl_kirim_unit'), 3, 2),
                'tgl_kirim_kp'=>$tglkirimKP,//substr(Input::get('tgl_kirim_kp'), 6, 4)."-".substr(Input::get('tgl_kirim_kp'), 0, 2)."-".  substr(Input::get('tgl_kirim_kp'), 3, 2),
                'bwmpkacab'=>Input::get('bwmpkacab'),
                'bwmpkp'=>Input::get('bwmpkp'),
                'tgl_realisasi'=>$tglrealisasi,//substr(Input::get('tgl_realisasi'), 6, 4)."-".substr(Input::get('tgl_realisasi'), 0, 2)."-".  substr(Input::get('tgl_realisasi'), 3, 2),
                'plafond_real'=>Input::get('plafond_real'),
                'keterangan'=>Input::get('keterangan'),
                'persetujuan'=>Input::get('persetujuan'),
                'update_date'=>date("Y-m-d h:i:s")
                 );
                $updater=Proposal::where('nomor_proposal_lain','=',$id)->update($simpan);
                Session::flash('message', 'DATA BERHASIL DIUPDATE!');
                return Redirect::to('aplikasi');
       //Session::get('message');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
               $updater=Proposal::where('nomor_proposal_lain','=',$id);
               $updater->delete();
               Session::flash('message', 'DATA BERHASIL DIHAPUS!');
                return Redirect::to('aplikasi');
	}
        
        public function exportxl(){
            
            //Menetukan letak file logo PNM pada laporan
                $jalan=app_path().'/views/images';
            //////////////////////////////////////
                //$tgl=date('Y-m-d',  strtotime(str_ireplace('/','-',Input::get('tgl'))));
                $bulan1=Input::get('bulan1');
                $tahun1=Input::get('tahun1');
                $bulan2=Input::get('bulan2');
                $tahun2=Input::get('tahun2');
                
                $export=DB::select('select * from `proposals` where month(tgl_masuk_proposal) >= ? and month(tgl_masuk_proposal) <= ? and year(tgl_masuk_proposal)>= ? and year(tgl_masuk_proposal) <= ?',array($bulan1,$bulan2,$tahun1,$tahun2));
                

                // Create new PHPExcel object
                $objPHPExcel = new PHPExcel();

                // Set document properties
                $objPHPExcel->getProperties()->setCreator("irham")
                                                                         ->setLastModifiedBy("Irham Syah")
                                                                         ->setTitle("Data Proposal ULaMM")
                                                                         ->setSubject("Data Proposal ULaMM")
                                                                         ->setDescription("Menampilkan Data Proposal ULaMM dalam file excel")
                                                                         ->setKeywords("Data Proposal ULaMM")
                                                                         ->setCategory("Data Proposal");

                // Create the worksheet
                $objPHPExcel->setActiveSheetIndex(0);

                // mulai judul kolom dengan row 12
                $objPHPExcel->getActiveSheet()->setCellValue('A12', "NO_PROPOSAL")
                                              ->setCellValue('B12', "NAMA DEBITUR")
                                              ->setCellValue('C12', "TGL MASUK PROPOSAL")
                                              ->setCellValue('D12', "PLAFOND PENGAJUAN")
                                              ->setCellValue('E12', "UNIT")
                                              ->setCellValue('F12', "PRODUK")
                                              ->setCellValue('G12', "FASILITAS")
                                              ->setCellValue('H12', "BWMP CABANG")
                                              ->setCellValue('I12', "TGL KRIM UNIT")
                                              ->setCellValue('J12', "TGL REALISASI")
                                              ->setCellValue('K12', "PLAFOND REALISASI")
                                              ->setCellValue('L12', "STATUS PERSETUJUAN")
                                              ->setCellValue('M12', "KETERANGAN");
                                              

                $dataArray= array();
                $no=0;
                $jumlah = count($export);
                
                // menampilkan data, susunan field sesuai dengan urutan judul kolom 
                $jmlplf_pngj=0;
                $jmlplf_real=0;
                foreach($export as $key=>$value){
                        $no++;
                        $jmlplf_pngj=$jmlplf_pngj+$value->plafond_pengajuan;
                        $jmlplf_real=$jmlplf_real+$value->plafond_real;
                                
                        $row_array['noproposal']    = $value->nomor_proposal;
                        $row_array['nama']          = $value->nama_debitur;
                        $row_array['tglprop']       = $value->tgl_masuk_proposal;
                        $row_array['plafond']       = number_format($value->plafond_pengajuan, 2, '.', ',');
                        $row_array['unit']          = $value->unit;
                        $row_array['produk']        = $value->produk;
                        $row_array['fasilitas']     = $value->fasilitas;
                        $row_array['bwmpkacab']     = $value->bwmpkacab;
                        $row_array['tglkirimunit']  = $value->tgl_kirim_unit;
                        $row_array['tglreal']       = $value->tgl_realisasi;
                        $row_array['plfreal']       = number_format($value->plafond_real, 2, '.', ',');
                        $row_array['stssetuju']     = $value->persetujuan;
                        $row_array['ket']     = $value->keterangan;
                        array_push($dataArray,$row_array);
                }

                // Mulai record dengan row 8
                $jmlplf_pngj=number_format($jmlplf_pngj,2,'.',',');
                $jmlplf_real=number_format($jmlplf_real,2,'.',',');
                $nox=$no+12;
                $nox2=$no+13;
                $objPHPExcel->getActiveSheet()->fromArray($dataArray, NULL, 'A13'); 

                // Set page orientation, Scaling(%) and size
                $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
                $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
                $objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(12, 12);
                $objPHPExcel->getActiveSheet()->getPageSetup()->setScale(61);
                $objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.75);
                $objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0);
                $objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.25);
                $objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.65);
                $objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

                // Set title row bold;
                $objPHPExcel->getActiveSheet()->getStyle('A12:M12')->getFont()->setBold(true);
                // Set fills
                $objPHPExcel->getActiveSheet()->getStyle('A12:M12')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $objPHPExcel->getActiveSheet()->getStyle('A12:M12')->getFill()->getStartColor()->setARGB('FF808080');

                //untuk auto size colomn / Menetukan besar kolom
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(11);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);

                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                $sharedStyle1 = new PHPExcel_Style();
                $sharedStyle2 = new PHPExcel_Style();

                $sharedStyle1->applyFromArray(
                 array('borders' => array(
                 'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                 'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                 'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                 'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
                 ),
                 ));

                $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "A12:M$nox");

                // Set style for header row using alternative method
                $objPHPExcel->getActiveSheet()->getStyle('A12:M12')->applyFromArray(
                 array(
                 'font' => array(
                 'bold' => true
                 ),
                 'alignment' => array(
                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                 ),
                 'borders' => array(
                 'top' => array(
                 'style' => PHPExcel_Style_Border::BORDER_THIN
                 )
                 ),
                 'fill' => array(
                 'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                 'rotation' => 90,
                 'startcolor' => array(
                 'argb' => 'FFA0A0A0'
                 ),
                 'endcolor' => array(
                 'argb' => 'FFFFFFFF'
                 )
                 )
                 )
                );
                //Format Style Kolom Plafon pengajuan
                $objPHPExcel->getActiveSheet()->getStyle("D13:D$nox2")->applyFromArray(
                 array(
                 'font' => array(
                 'bold' => true
                 ),
                 'alignment' => array(
                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                 )
                 )
                 
                );

                //
 
                //Format Style Kolom Plafon Realisasi
                $objPHPExcel->getActiveSheet()->getStyle("K13:K$nox2")->applyFromArray(
                 array(
                 'font' => array(
                 'bold' => true
                 ),
                 'alignment' => array(
                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                 )
                 )
                );

                //

                // Add a drawing to the worksheet
                $objDrawing = new PHPExcel_Worksheet_Drawing();
                $objDrawing->setName('Logo');
                $objDrawing->setDescription('Logo');
                $objDrawing->setPath($jalan.'\logo.png');
                $objDrawing->setCoordinates('A2');
                $objDrawing->setHeight(100);
                $objDrawing->setWidth(100);
                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

                //untuk font dan size data
                $objPHPExcel->getActiveSheet()->getStyle('A12:J1000')->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle('A12:J1000')->getFont()->setSize(9);

                // Mulai Merge cells Judul
                $objPHPExcel->getActiveSheet()->mergeCells('C2:I2');
                $objPHPExcel->getActiveSheet()->setCellValue('C2', "DAFTAR DATA PROPOSAL ULaMM SURABAYA ".date("Y"));

                $objPHPExcel->getActiveSheet()->getStyle('C2:I5')->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle('C2:I5')->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('C2:I5')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('C3:I5')->getFont()->setSize(13);

                // untuk sub judul
                $objPHPExcel->getActiveSheet()->setCellValue('I7', "Jumlah Data : $jumlah");

                $objPHPExcel->getActiveSheet()->setCellValue('A8', "Kota : Surabaya");
                $objPHPExcel->getActiveSheet()->setCellValue('A9', "Propinsi : Jawa Timur");
                
                //Untuk Membuat Sheet Menampilkan Grand Total
                $objPHPExcel->getActiveSheet()->setCellValue("A$nox2", "GRAND TOTAL");
                $objPHPExcel->getActiveSheet()->getStyle("A$nox2")->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle("A$nox2")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle("A$nox2")->getFont()->setitalic(true);
                $objPHPExcel->getActiveSheet()->getStyle("A$nox2")->getFont()->setSize(13);      
                
                $objPHPExcel->getActiveSheet()->setCellValue("D$nox2", "$jmlplf_pngj");
                $objPHPExcel->getActiveSheet()->getStyle("D$nox2")->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle("D$nox2")->getFont()->setSize(9);
                $objPHPExcel->getActiveSheet()->getStyle("D$nox2")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle("D$nox2")->getFont()->setitalic(true);
                $objPHPExcel->getActiveSheet()->setCellValue("K$nox2", "$jmlplf_real");
                $objPHPExcel->getActiveSheet()->getStyle("K$nox2")->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle("K$nox2")->getFont()->setSize(9);
                $objPHPExcel->getActiveSheet()->getStyle("K$nox2")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle("K$nox2")->getFont()->setitalic(true);

                
                $objPHPExcel->getActiveSheet()->getStyle('A7:I9')->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle('A7:I9')->getFont()->setSize(9);

                // Judul Center
                $objPHPExcel->getActiveSheet()->getStyle('A2:I6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                // Redirect output to a client’s web browser (Excel2007)
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="DATA_PROP"'.date("d-F-Y").'".xlsx"');
                header('Cache-Control: max-age=0');

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                exit;

                // Save Excel 2007 file
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        }
        
        public function exportpencairan(){
            
            //Menetukan letak file logo
                $jalan=app_path().'/views/images';
                $bulan1=Input::get('bulan1');
                $tahun1=Input::get('tahun1');
                $bulan2=Input::get('bulan2');
                $tahun2=Input::get('tahun2');
               
/*                if($inputan==''){
                    $export=Proposal::where('plafond_real','>','0')->get();
                }elseif($inputan<>'' && $inputan2==''){
                
                    $export=Proposal::where('persetujuan','like',$inputan.'%')->get();
                
                }else{
                    $export=Proposal::where('persetujuan','like',$inputan.'%')
                            ->where('plafond_real','=','0')
                            ->get();
                }*/
                $export=DB::select('select * from `proposals` where month(tgl_masuk_proposal) >= ? and month(tgl_masuk_proposal) <= ? and year(tgl_masuk_proposal)>= ? and year(tgl_masuk_proposal) <= ? and plafond_real>0',array($bulan1,$bulan2,$tahun1,$tahun2));

                // Create new PHPExcel object
                $objPHPExcel = new PHPExcel();

                // Set document properties
                $objPHPExcel->getProperties()->setCreator("irham")
                                                                         ->setLastModifiedBy("Irham Syah")
                                                                         ->setTitle("Data Proposal ULaMM")
                                                                         ->setSubject("Data Proposal ULaMM")
                                                                         ->setDescription("Menampilkan Data Proposal ULaMM dalam file excel")
                                                                         ->setKeywords("Data Proposal ULaMM")
                                                                         ->setCategory("Data Proposal");

                // Create the worksheet
                $objPHPExcel->setActiveSheetIndex(0);

                // mulai judul kolom dengan row 12
                $objPHPExcel->getActiveSheet()->setCellValue('A12', "NO_PROPOSAL")
                                              ->setCellValue('B12', "NAMA DEBITUR")
                                              ->setCellValue('C12', "TGL MASUK PROPOSAL")
                                              ->setCellValue('D12', "PLAFOND PENGAJUAN")
                                              ->setCellValue('E12', "UNIT")
                                              ->setCellValue('F12', "PRODUK")
                                              ->setCellValue('G12', "FASILITAS")
                                              ->setCellValue('H12', "BWMP CABANG")
                                              ->setCellValue('I12', "BWMP KP")                        
                                              ->setCellValue('J12', "TGL KRIM UNIT")
                                              ->setCellValue('K12', "TGL REALISASI")
                                              ->setCellValue('L12', "PLAFOND REALISASI")
                                              ->setCellValue('M12', "STATUS");
                                              

                $dataArray= array();
                $no=0;
                $jumlah = count($export);
                
                $jmlplf_pngj=0;
                $jmlplf_real=0;
                foreach($export as $key=>$value){
                        $no++;
                        $jmlplf_pngj=$jmlplf_pngj+$value->plafond_pengajuan;
                        $jmlplf_real=$jmlplf_real+$value->plafond_real;
                                
                        $row_array['noproposal']    = $value->nomor_proposal;
                        $row_array['nama']          = $value->nama_debitur;
                        $row_array['tglprop']       = $value->tgl_masuk_proposal;
                        $row_array['plafond']       = number_format($value->plafond_pengajuan, 2, '.', ',');
                        $row_array['unit']          = $value->unit;
                        $row_array['produk']        = $value->produk;
                        $row_array['fasilitas']     = $value->fasilitas;
                        $row_array['bwmpkacab']     = $value->bwmpkacab;
                        $row_array['bwmpkp']        = $value->bwmpkp;
                        $row_array['tglkirimunit']  = $value->tgl_kirim_unit;
                        $row_array['tglreal']       = $value->tgl_realisasi;
                        $row_array['plfreal']       = number_format($value->plafond_real, 2, '.', ',');
                        $row_array['stssetuju']     = $value->persetujuan;
                        $row_array['ket']     = $value->keterangan;
                        array_push($dataArray,$row_array);
                }

                // Mulai record dengan row 8
                $jmlplf_pngj=number_format($jmlplf_pngj,2,'.',',');
                $jmlplf_real=number_format($jmlplf_real,2,'.',',');
                $nox=$no+12;
                $nox2=$no+13;
                $objPHPExcel->getActiveSheet()->fromArray($dataArray, NULL, 'A13'); 

                // Set page orientation and size
                $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
                $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
                $objPHPExcel->getActiveSheet()->getPageSetup()->setScale(59);
                $objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(12, 12);
                $objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.75);
                $objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0);
                $objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.25);
                $objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.75);
                $objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

                // Set title row bold;
                $objPHPExcel->getActiveSheet()->getStyle('A12:M12')->getFont()->setBold(true);
                // Set fills
                $objPHPExcel->getActiveSheet()->getStyle('A12:M12')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $objPHPExcel->getActiveSheet()->getStyle('A12:M12')->getFill()->getStartColor()->setARGB('FF808080');

                //untuk auto size colomn / Menetukan besar kolom
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(11);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);

                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                $sharedStyle1 = new PHPExcel_Style();
                $sharedStyle2 = new PHPExcel_Style();

                $sharedStyle1->applyFromArray(
                 array('borders' => array(
                 'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                 'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                 'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                 'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
                 ),
                 ));

                $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "A12:M$nox");

                // Set style for header row using alternative method
                $objPHPExcel->getActiveSheet()->getStyle('A12:M12')->applyFromArray(
                 array(
                 'font' => array(
                 'bold' => true
                 ),
                 'alignment' => array(
                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                 ),
                 'borders' => array(
                 'top' => array(
                 'style' => PHPExcel_Style_Border::BORDER_THIN
                 )
                 ),
                 'fill' => array(
                 'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                 'rotation' => 90,
                 'startcolor' => array(
                 'argb' => 'FFA0A0A0'
                 ),
                 'endcolor' => array(
                 'argb' => 'FFFFFFFF'
                 )
                 )
                 )
                );
                //Format Style Kolom Plafon pengajuan
                $objPHPExcel->getActiveSheet()->getStyle("D13:D$nox2")->applyFromArray(
                 array(
                 'font' => array(
                 'bold' => true
                 ),
                 'alignment' => array(
                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                 )
                 )
                 
                );

                //
 
                //Format Style Kolom Plafon Realisasi
                $objPHPExcel->getActiveSheet()->getStyle("K13:K$nox2")->applyFromArray(
                 array(
                 'font' => array(
                 'bold' => true
                 ),
                 'alignment' => array(
                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                 )
                 )
                );

                //

                // Add a drawing to the worksheet
                $objDrawing = new PHPExcel_Worksheet_Drawing();
                $objDrawing->setName('Logo');
                $objDrawing->setDescription('Logo');
                $objDrawing->setPath($jalan.'\logo.png');
                $objDrawing->setCoordinates('A2');
                $objDrawing->setHeight(100);
                $objDrawing->setWidth(100);
                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

                //untuk font dan size data
                $objPHPExcel->getActiveSheet()->getStyle('A12:J1000')->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle('A12:J1000')->getFont()->setSize(9);

                // Mulai Merge cells Judul
                $objPHPExcel->getActiveSheet()->mergeCells('C2:I2');
                $objPHPExcel->getActiveSheet()->setCellValue('C2', "DAFTAR REALISASI PROPOSAL ULaMM SURABAYA ".date("Y"));

                $objPHPExcel->getActiveSheet()->getStyle('C2:I5')->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle('C2:I5')->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('C2:I5')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('C3:I5')->getFont()->setSize(13);

                // untuk sub judul
                $objPHPExcel->getActiveSheet()->setCellValue('I7', "Jumlah Data : $jumlah");

                $objPHPExcel->getActiveSheet()->setCellValue('A8', "Kota : Surabaya");
                $objPHPExcel->getActiveSheet()->setCellValue('A9', "Propinsi : Jawa Timur");
                
                //Untuk Membuat Sheet Menampilkan Grand Total
                $objPHPExcel->getActiveSheet()->setCellValue("A$nox2", "GRAND TOTAL");
                $objPHPExcel->getActiveSheet()->getStyle("A$nox2")->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle("A$nox2")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle("A$nox2")->getFont()->setitalic(true);
                $objPHPExcel->getActiveSheet()->getStyle("A$nox2")->getFont()->setSize(13);      
                
                $objPHPExcel->getActiveSheet()->setCellValue("D$nox2", "$jmlplf_pngj");
                $objPHPExcel->getActiveSheet()->getStyle("D$nox2")->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle("D$nox2")->getFont()->setSize(9);
                $objPHPExcel->getActiveSheet()->getStyle("D$nox2")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle("D$nox2")->getFont()->setitalic(true);
                $objPHPExcel->getActiveSheet()->setCellValue("K$nox2", "$jmlplf_real");
                $objPHPExcel->getActiveSheet()->getStyle("K$nox2")->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle("K$nox2")->getFont()->setSize(9);
                $objPHPExcel->getActiveSheet()->getStyle("K$nox2")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle("K$nox2")->getFont()->setitalic(true);

                
                $objPHPExcel->getActiveSheet()->getStyle('A7:I9')->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle('A7:I9')->getFont()->setSize(9);

                // Judul Center
                $objPHPExcel->getActiveSheet()->getStyle('A2:I6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                // Redirect output to a client’s web browser (Excel2007)
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="DATA_PROP_REAL"'.date("d-F-Y").'".xlsx"');
                header('Cache-Control: max-age=0');

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                exit;

                // Save Excel 2007 file
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        }
        
        //Ajax-search
        public function exportbelumcair(){
                $jalan=app_path().'/views/images';
            //////////////////////////////////////
                //$tgl=date('Y-m-d',  strtotime(str_ireplace('/','-',Input::get('tgl'))));
                $bulan1=Input::get('bulan1');
                $tahun1=Input::get('tahun1');
                $bulan2=Input::get('bulan2');
                $tahun2=Input::get('tahun2');
                
                $export=DB::select('select * from `proposals` where month(tgl_masuk_proposal) >= ? and month(tgl_masuk_proposal) <= ? and year(tgl_masuk_proposal)>= ? and year(tgl_masuk_proposal) <= ? AND plafond_real=0 AND persetujuan="disetujui"',array($bulan1,$bulan2,$tahun1,$tahun2));
                

                // Create new PHPExcel object
                $objPHPExcel = new PHPExcel();

                // Set document properties
                $objPHPExcel->getProperties()->setCreator("irham")
                                                                         ->setLastModifiedBy("Irham Syah")
                                                                         ->setTitle("Data Proposal ULaMM")
                                                                         ->setSubject("Data Proposal ULaMM")
                                                                         ->setDescription("Menampilkan Data Proposal ULaMM dalam file excel")
                                                                         ->setKeywords("Data Proposal ULaMM")
                                                                         ->setCategory("Data Proposal");

                // Create the worksheet
                $objPHPExcel->setActiveSheetIndex(0);

                // mulai judul kolom dengan row 12
                $objPHPExcel->getActiveSheet()->setCellValue('A12', "NO_PROPOSAL")
                                              ->setCellValue('B12', "NAMA DEBITUR")
                                              ->setCellValue('C12', "TGL MASUK PROPOSAL")
                                              ->setCellValue('D12', "PLAFOND PENGAJUAN")
                                              ->setCellValue('E12', "UNIT")
                                              ->setCellValue('F12', "PRODUK")
                                              ->setCellValue('G12', "FASILITAS")
                                              ->setCellValue('H12', "BWMP CABANG")
                                              ->setCellValue('I12', "BWMP KP")                        
                                              ->setCellValue('J12', "TGL KRIM UNIT")
                                              ->setCellValue('K12', "PLAFOND REALISASI")
                                              ->setCellValue('L12', "STATUS PERSETUJUAN");

                                              

                $dataArray= array();
                $no=0;
                $jumlah = count($export);
                
                $jmlplf_pngj=0;
                $jmlplf_real=0;
                foreach($export as $key=>$value){
                        $no++;
                        $jmlplf_pngj=$jmlplf_pngj+$value->plafond_pengajuan;
                        $jmlplf_real=$jmlplf_real+$value->plafond_real;
                                
                        $row_array['noproposal']    = $value->nomor_proposal;
                        $row_array['nama']          = $value->nama_debitur;
                        $row_array['tglprop']       = $value->tgl_masuk_proposal;
                        $row_array['plafond']       = number_format($value->plafond_pengajuan, 2, '.', ',');
                        $row_array['unit']          = $value->unit;
                        $row_array['produk']        = $value->produk;
                        $row_array['fasilitas']     = $value->fasilitas;
                        $row_array['bwmpkacab']     = $value->bwmpkacab;
                        $row_array['bwmpkp']        = $value->bwmpkp;                        
                        $row_array['tglkirimunit']  = $value->tgl_kirim_unit;
                        $row_array['plfreal']       = number_format($value->plafond_real, 2, '.', ',');
                        $row_array['stssetuju']     = $value->persetujuan;
                        $row_array['ket']           = $value->keterangan;
                        array_push($dataArray,$row_array);
                }

                // Mulai record dengan row 8
                $jmlplf_pngj=number_format($jmlplf_pngj,2,'.',',');
                $jmlplf_real=number_format($jmlplf_real,2,'.',',');
                $nox=$no+12;
                $nox2=$no+13;
                $objPHPExcel->getActiveSheet()->fromArray($dataArray, NULL, 'A13'); 

                // Set page orientation, Scaling(%), Rows Reat At top and size
                $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
                $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
                $objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(12, 12);
                $objPHPExcel->getActiveSheet()->getPageSetup()->setScale(72);
                $objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.75);
                $objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0);
                $objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.25);
                $objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.75);
                $objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

                // Set title row bold;
                $objPHPExcel->getActiveSheet()->getStyle('A12:M12')->getFont()->setBold(true);
                // Set fills
                $objPHPExcel->getActiveSheet()->getStyle('A12:M12')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $objPHPExcel->getActiveSheet()->getStyle('A12:M12')->getFill()->getStartColor()->setARGB('FF808080');

                //untuk auto size colomn / Menetukan besar kolom
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(11);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);

                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                $sharedStyle1 = new PHPExcel_Style();
                $sharedStyle2 = new PHPExcel_Style();

                $sharedStyle1->applyFromArray(
                 array('borders' => array(
                 'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                 'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                 'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                 'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
                 ),
                 ));

                $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "A12:M$nox");

                // Set style for header row using alternative method
                $objPHPExcel->getActiveSheet()->getStyle('A12:M12')->applyFromArray(
                 array(
                 'font' => array(
                 'bold' => true
                 ),
                 'alignment' => array(
                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                 ),
                 'borders' => array(
                 'top' => array(
                 'style' => PHPExcel_Style_Border::BORDER_THIN
                 )
                 ),
                 'fill' => array(
                 'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                 'rotation' => 90,
                 'startcolor' => array(
                 'argb' => 'FFA0A0A0'
                 ),
                 'endcolor' => array(
                 'argb' => 'FFFFFFFF'
                 )
                 )
                 )
                );
                //Format Style Kolom Plafon pengajuan
                $objPHPExcel->getActiveSheet()->getStyle("D13:D$nox2")->applyFromArray(
                 array(
                 'font' => array(
                 'bold' => true
                 ),
                 'alignment' => array(
                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                 )
                 )
                 
                );

                //
 
                //Format Style Kolom Plafon Realisasi
                $objPHPExcel->getActiveSheet()->getStyle("K13:K$nox2")->applyFromArray(
                 array(
                 'font' => array(
                 'bold' => true
                 ),
                 'alignment' => array(
                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                 )
                 )
                );

                //

                // Add a drawing to the worksheet
                $objDrawing = new PHPExcel_Worksheet_Drawing();
                $objDrawing->setName('Logo');
                $objDrawing->setDescription('Logo');
                $objDrawing->setPath($jalan.'\logo.png');
                $objDrawing->setCoordinates('A2');
                $objDrawing->setHeight(100);
                $objDrawing->setWidth(100);
                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

                //untuk font dan size data
                $objPHPExcel->getActiveSheet()->getStyle('A12:J1000')->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle('A12:J1000')->getFont()->setSize(9);

                // Mulai Merge cells Judul
                $objPHPExcel->getActiveSheet()->mergeCells('C2:M2');
                $objPHPExcel->getActiveSheet()->setCellValue('C2', "DAFTAR DATA PROPOSAL ULaMM SURABAYA DISETUJUI BELUM REALISASI ".date("Y"));

                $objPHPExcel->getActiveSheet()->getStyle('C2:I5')->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle('C2:I5')->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('C2:I5')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('C3:I5')->getFont()->setSize(13);

                // untuk sub judul
                $objPHPExcel->getActiveSheet()->setCellValue('I7', "Jumlah Data : $jumlah");

                $objPHPExcel->getActiveSheet()->setCellValue('A8', "Kota : Surabaya");
                $objPHPExcel->getActiveSheet()->setCellValue('A9', "Propinsi : Jawa Timur");
                
                //Untuk Membuat Sheet Menampilkan Grand Total
                $objPHPExcel->getActiveSheet()->setCellValue("A$nox2", "GRAND TOTAL");
                $objPHPExcel->getActiveSheet()->getStyle("A$nox2")->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle("A$nox2")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle("A$nox2")->getFont()->setitalic(true);
                $objPHPExcel->getActiveSheet()->getStyle("A$nox2")->getFont()->setSize(13);      
                
                $objPHPExcel->getActiveSheet()->setCellValue("D$nox2", "$jmlplf_pngj");
                $objPHPExcel->getActiveSheet()->getStyle("D$nox2")->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle("D$nox2")->getFont()->setSize(9);
                $objPHPExcel->getActiveSheet()->getStyle("D$nox2")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle("D$nox2")->getFont()->setitalic(true);
                $objPHPExcel->getActiveSheet()->setCellValue("K$nox2", "$jmlplf_real");
                $objPHPExcel->getActiveSheet()->getStyle("K$nox2")->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle("K$nox2")->getFont()->setSize(9);
                $objPHPExcel->getActiveSheet()->getStyle("K$nox2")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle("K$nox2")->getFont()->setitalic(true);

                
                $objPHPExcel->getActiveSheet()->getStyle('A7:I9')->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle('A7:I9')->getFont()->setSize(9);

                // Judul Center
                $objPHPExcel->getActiveSheet()->getStyle('A2:I6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                // Redirect output to a client’s web browser (Excel2007)
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="DATA_PROP_BLM_REAL"'.date("d-F-Y").'".xlsx"');
                header('Cache-Control: max-age=0');

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                exit;

                // Save Excel 2007 file
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save(str_replace('.php', '.xlsx', __FILE__));

        }

        public function exporttidaksetuju(){
                 $jalan=app_path().'/views/images';
            //////////////////////////////////////
                //$tgl=date('Y-m-d',  strtotime(str_ireplace('/','-',Input::get('tgl'))));
                $bulan1=Input::get('bulan1');
                $tahun1=Input::get('tahun1');
                $bulan2=Input::get('bulan2');
                $tahun2=Input::get('tahun2');
                
                $export=DB::select('select * from `proposals` where month(tgl_masuk_proposal) >= ? and month(tgl_masuk_proposal) <= ? and year(tgl_masuk_proposal)>= ? and year(tgl_masuk_proposal) <= ? AND plafond_real=0 AND persetujuan like "tidak%"',array($bulan1,$bulan2,$tahun1,$tahun2));
                

                // Create new PHPExcel object
                $objPHPExcel = new PHPExcel();

                // Set document properties
                $objPHPExcel->getProperties()->setCreator("irham")
                                                                         ->setLastModifiedBy("Irham Syah")
                                                                         ->setTitle("Data Proposal ULaMM")
                                                                         ->setSubject("Data Proposal ULaMM")
                                                                         ->setDescription("Menampilkan Data Proposal ULaMM dalam file excel")
                                                                         ->setKeywords("Data Proposal ULaMM")
                                                                         ->setCategory("Data Proposal");

                // Create the worksheet
                $objPHPExcel->setActiveSheetIndex(0);

                // mulai judul kolom dengan row 12
                $objPHPExcel->getActiveSheet()->setCellValue('A12', "NO_PROPOSAL")
                                              ->setCellValue('B12', "NAMA DEBITUR")
                                              ->setCellValue('C12', "TGL MASUK PROPOSAL")
                                              ->setCellValue('D12', "PLAFOND PENGAJUAN")
                                              ->setCellValue('E12', "UNIT")
                                              ->setCellValue('F12', "PRODUK")
                                              ->setCellValue('G12', "FASILITAS")
                                              ->setCellValue('H12', "BWMP CABANG")
                                              ->setCellValue('I12', "TGL KRIM UNIT")
                                              ->setCellValue('J12', "TGL REALISASI")
                                              ->setCellValue('K12', "PLAFOND REALISASI")
                                              ->setCellValue('L12', "STATUS PERSETUJUAN")
                                              ->setCellValue('M12', "STATUS PERSETUJUAN");

                                              

                $dataArray= array();
                $no=0;
                $jumlah = count($export);
                
                $jmlplf_pngj=0;
                $jmlplf_real=0;
                foreach($export as $key=>$value){
                        $no++;
                        $jmlplf_pngj=$jmlplf_pngj+$value->plafond_pengajuan;
                        $jmlplf_real=$jmlplf_real+$value->plafond_real;
                                
                        $row_array['noproposal']    = $value->nomor_proposal;
                        $row_array['nama']          = $value->nama_debitur;
                        $row_array['tglprop']       = $value->tgl_masuk_proposal;
                        $row_array['plafond']       = number_format($value->plafond_pengajuan, 2, '.', ',');
                        $row_array['unit']          = $value->unit;
                        $row_array['produk']        = $value->produk;
                        $row_array['fasilitas']     = $value->fasilitas;
                        $row_array['bwmpkacab']     = $value->bwmpkacab;
                        $row_array['tglkirimunit']  = $value->tgl_kirim_unit;
                        $row_array['tglreal']       = $value->tgl_realisasi;
                        $row_array['plfreal']       = number_format($value->plafond_real, 2, '.', ',');
                        $row_array['stssetuju']     = $value->persetujuan;
                        $row_array['ket']     = $value->keterangan;
                        array_push($dataArray,$row_array);
                }

                // Mulai record dengan row 8
                $jmlplf_pngj=number_format($jmlplf_pngj,2,'.',',');
                $jmlplf_real=number_format($jmlplf_real,2,'.',',');
                $nox=$no+12;
                $nox2=$no+13;
                $objPHPExcel->getActiveSheet()->fromArray($dataArray, NULL, 'A13'); 

                // Set page orientation and size
                $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
                $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
                $objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(12, 12);
                $objPHPExcel->getActiveSheet()->getPageSetup()->setScale(72);
                $objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.75);
                $objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.75);
                $objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.75);
                $objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.75);
                $objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

                // Set title row bold;
                $objPHPExcel->getActiveSheet()->getStyle('A12:M12')->getFont()->setBold(true);
                // Set fills
                $objPHPExcel->getActiveSheet()->getStyle('A12:M12')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $objPHPExcel->getActiveSheet()->getStyle('A12:M12')->getFill()->getStartColor()->setARGB('FF808080');

                //untuk auto size colomn / Menetukan besar kolom
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(11);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);

                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                $sharedStyle1 = new PHPExcel_Style();
                $sharedStyle2 = new PHPExcel_Style();

                $sharedStyle1->applyFromArray(
                 array('borders' => array(
                 'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                 'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                 'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                 'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
                 ),
                 ));

                $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "A12:M$nox");

                // Set style for header row using alternative method
                $objPHPExcel->getActiveSheet()->getStyle('A12:M12')->applyFromArray(
                 array(
                 'font' => array(
                 'bold' => true
                 ),
                 'alignment' => array(
                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                 ),
                 'borders' => array(
                 'top' => array(
                 'style' => PHPExcel_Style_Border::BORDER_THIN
                 )
                 ),
                 'fill' => array(
                 'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                 'rotation' => 90,
                 'startcolor' => array(
                 'argb' => 'FFA0A0A0'
                 ),
                 'endcolor' => array(
                 'argb' => 'FFFFFFFF'
                 )
                 )
                 )
                );
                //Format Style Kolom Plafon pengajuan
                $objPHPExcel->getActiveSheet()->getStyle("D13:D$nox2")->applyFromArray(
                 array(
                 'font' => array(
                 'bold' => true
                 ),
                 'alignment' => array(
                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                 )
                 )
                 
                );

                //
 
                //Format Style Kolom Plafon Realisasi
                $objPHPExcel->getActiveSheet()->getStyle("K13:K$nox2")->applyFromArray(
                 array(
                 'font' => array(
                 'bold' => true
                 ),
                 'alignment' => array(
                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                 )
                 )
                );

                //

                // Add a drawing to the worksheet
                $objDrawing = new PHPExcel_Worksheet_Drawing();
                $objDrawing->setName('Logo');
                $objDrawing->setDescription('Logo');
                $objDrawing->setPath($jalan.'\logo.png');
                $objDrawing->setCoordinates('A2');
                $objDrawing->setHeight(100);
                $objDrawing->setWidth(100);
                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

                //untuk font dan size data
                $objPHPExcel->getActiveSheet()->getStyle('A12:J1000')->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle('A12:J1000')->getFont()->setSize(9);

                // Mulai Merge cells Judul
                $objPHPExcel->getActiveSheet()->mergeCells('C2:J2');
                $objPHPExcel->getActiveSheet()->setCellValue('C2', "DAFTAR ROPOSAL ULaMM SURABAYA TIDAK DSETUJUI".date("Y"));

                $objPHPExcel->getActiveSheet()->getStyle('C2:I5')->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle('C2:I5')->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('C2:I5')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('C3:I5')->getFont()->setSize(13);

                // untuk sub judul
                $objPHPExcel->getActiveSheet()->setCellValue('I7', "Jumlah Data : $jumlah");

                $objPHPExcel->getActiveSheet()->setCellValue('A8', "Kota : Surabaya");
                $objPHPExcel->getActiveSheet()->setCellValue('A9', "Propinsi : Jawa Timur");
                
                //Untuk Membuat Sheet Menampilkan Grand Total
                $objPHPExcel->getActiveSheet()->setCellValue("A$nox2", "GRAND TOTAL");
                $objPHPExcel->getActiveSheet()->getStyle("A$nox2")->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle("A$nox2")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle("A$nox2")->getFont()->setitalic(true);
                $objPHPExcel->getActiveSheet()->getStyle("A$nox2")->getFont()->setSize(13);      
                
                $objPHPExcel->getActiveSheet()->setCellValue("D$nox2", "$jmlplf_pngj");
                $objPHPExcel->getActiveSheet()->getStyle("D$nox2")->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle("D$nox2")->getFont()->setSize(9);
                $objPHPExcel->getActiveSheet()->getStyle("D$nox2")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle("D$nox2")->getFont()->setitalic(true);
                $objPHPExcel->getActiveSheet()->setCellValue("K$nox2", "$jmlplf_real");
                $objPHPExcel->getActiveSheet()->getStyle("K$nox2")->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle("K$nox2")->getFont()->setSize(9);
                $objPHPExcel->getActiveSheet()->getStyle("K$nox2")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle("K$nox2")->getFont()->setitalic(true);

                
                $objPHPExcel->getActiveSheet()->getStyle('A7:I9')->getFont()->setName('Arial');
                $objPHPExcel->getActiveSheet()->getStyle('A7:I9')->getFont()->setSize(9);

                // Judul Center
                $objPHPExcel->getActiveSheet()->getStyle('A2:I6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                // Redirect output to a client’s web browser (Excel2007)
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="DATA_PROP_TDK_STJ"'.date("d-F-Y").'".xlsx"');
                header('Cache-Control: max-age=0');

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                exit;

                // Save Excel 2007 file
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save(str_replace('.php', '.xlsx', __FILE__));

        }
        
        public function getDetails($id)
	{
		//Retrieve post details     
	        $data["post"] = Proposal::post_details($id);
	        
	        //Retrieve comments for this post
	        $data["comments"] = $comments = Proposal::post_comments($id,4);
	        
	        //Comments pagination
	        $data["comments_pages"] = $comments->links();

	        if(Request::ajax())
	        {
			$html = View::make('aplikasi.ajax-search', $data)->render();
			return Response::json(array('html' => $html));
	        }
	
	        return View::make('blog.post', $data);
	}
        
      
}