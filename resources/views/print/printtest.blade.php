<table class="table" style="margin-right: -20px;">
    <tbody>
        <?php
        $page = intval($qty) / 12;
        $row = intval($qty) / 3;
        $column = intval($qty);
        $a = 1;
        ?>

        @for ($b = 0; $b < ceil($row); $b++)
            <?php
            $hasil = $b + 1;
            $hasil_old = $b;
            $line = $hasil * 3;
            
            if ($line >= intval($qty)) {
                $col = $column - $hasil_old * 3;
            } else {
                $col = 3;
            }
            
            ?>
            <tr>
                @for ($c = 0; $c < $col; $c++)
                    <td align="center" style="padding-left: 28px;padding-top: 42px;width:100px;">
                        <div class="mpdf_toc">
                            <span style="font-size: 12px;">{{ Str::limit($produk, 25) }}</span>
                            <span align="center">
                                <barcode code="{{ $v_id_produk }}.{{ $size }}" type="C39" height="2.7" size="0.7" />
                            </span>
                            <span class="text-center fw-bold"
                                style="font-size: 14px;font-weight: bold;">#{{ $idpo }} | </span>
                            <span>{{ $v_id_produk }}.{{ $size }}</span>
                        </div>
                    </td>
                @endfor
            </tr>
        @endfor

    </tbody>
</table>
<style>
    div.rounded {
        border: 1mm dashed #220044;
        background-color: #f0f2ff;
        border-radius: 3mm / 3mm;
        background-clip: border-box;
        padding: 1em;
    }

    div.mpdf_toc {
        font-family: sans-serif;
        font-size: 11pt;
    }

    a.mpdf_toc_a {
        text-decoration: none;
        color: black;
    }

    /* Whole line level 0 */
    div.mpdf_toc_level_0 {
        line-height: 1.5;
        margin-left: 0;
        padding-right: 2em;
    }

    /* padding-right should match e.g <dottab outdent="2em" /> 0 is default */
    /* Title level 0 - may be inside <a> */
    span.mpdf_toc_t_level_0 {
        font-weight: bold;
    }

    /* Page no. level 0 - may be inside <a> */
    span.mpdf_toc_p_level_0 {}

    /* Whole line level 1 */
    div.mpdf_toc_level_1 {
        margin-left: 2em;
        text-indent: -2em;
        padding-right: 2em;
    }

    /* padding-right should match <dottab outdent="2em" /> 2em is default */
    /* Title level 1 */
    span.mpdf_toc_t_level_1 {
        font-style: italic;
        font-weight: bold;
    }

    /* Page no. level 1 - may be inside <a> */
    span.mpdf_toc_p_level_1 {}

    /* Whole line level 2 */
    div.mpdf_toc_level_2 {
        margin-left: 4em;
        text-indent: -2em;
        padding-right: 2em;
    }

    /* padding-right should match <dottab outdent="2em" /> 2em is default */
    /* Title level 2 */
    span.mpdf_toc_t_level_2 {}

    /* Page no. level 2 - may be inside <a> */
    span.mpdf_toc_p_level_2 {}
</style>
{{-- 
<div class="mpdf_toc" id="mpdf_toc_0">
    <div class="mpdf_toc_level_0">
        <a class="mpdf_toc_a" href="#__mpdfinternallink_1">
            <span class="mpdf_toc_t_level_0">Section 1</span>
        </a>
        <dottab outdent="2em" />
        <a class="mpdf_toc_a" href="#__mpdfinternallink_1">
            <span class="mpdf_toc_p_level_0">5</span>
        </a>
    </div>
    <div class="mpdf_toc_level_1">
        <a class="mpdf_toc_a" href="#__mpdfinternallink_2">
            <span class="mpdf_toc_t_level_1">Chapter 1</span>
        </a>
        <dottab outdent="2em" />
        <a class="mpdf_toc_a" href="#__mpdfinternallink_2">
            <span class="mpdf_toc_p_level_1">5</span>
        </a>
    </div>
    <div class="mpdf_toc_level_2">
        <a class="mpdf_toc_a" href="#__mpdfinternallink_3">
            <span class="mpdf_toc_t_level_2">Topic 1</span>
        </a>
        <dottab outdent="2em" />
        <a class="mpdf_toc_a" href="#__mpdfinternallink_3">
            <span class="mpdf_toc_p_level_2">5</span>
        </a>
    </div>
</div> --}}
