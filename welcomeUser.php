<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.php");
}
else
{
require 'header.php';

?>
                            <style>
                              input[type=number]::-webkit-outer-spin-button,
                              input[type=number]::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
                              input[type=number] { -moz-appearance: textfield; }

                              /* ── Welcome Page ── */
                              .welcome-wrapper {
                                  min-height: calc(100vh - 57px);
                                  display: flex !important;
                                  flex-direction: column;
                                  align-items: center;
                                  justify-content: center;
                                  padding: 30px 20px;
                                  background: linear-gradient(135deg, #f0f4f8 0%, #dce3ea 100%);
                                  margin: -10px -20px 0;
                              }
                              .welcome-wrapper.settled {
                                  justify-content: flex-start;
                                  padding-top: 20px;
                              }

                              /* Animaciones de entrada */
                              @keyframes dropIn {
                                  0%   { opacity: 0; transform: translateY(-60px) scale(0.85); }
                                  70%  { transform: translateY(8px) scale(1.03); }
                                  100% { opacity: 1; transform: translateY(0) scale(1); }
                              }
                              @keyframes slideLeft {
                                  0%   { opacity: 0; transform: translateX(80px) rotate(6deg); }
                                  70%  { transform: translateX(-8px) rotate(-1deg); }
                                  100% { opacity: 1; transform: translateX(0) rotate(0deg); }
                              }
                              @keyframes slideRight {
                                  0%   { opacity: 0; transform: translateX(-80px) rotate(-6deg); }
                                  70%  { transform: translateX(8px) rotate(1deg); }
                                  100% { opacity: 1; transform: translateX(0) rotate(0deg); }
                              }

                              /* Logo stage */
                              .logo-stage {
                                  display: flex;
                                  flex-wrap: wrap;
                                  align-items: center;
                                  justify-content: center;
                                  gap: 24px;
                                  padding: 20px;
                                  transition: background   0.7s ease,
                                              box-shadow   0.7s ease,
                                              border-radius 0.7s ease,
                                              padding      0.7s ease,
                                              gap          0.7s ease;
                              }
                              .welcome-wrapper.settled .logo-stage {
                                  background: #fff;
                                  box-shadow: 0 4px 24px rgba(0,0,0,0.08);
                                  border-radius: 14px;
                                  padding: 14px 32px;
                                  gap: 28px;
                                  width: 100%;
                                  max-width: 900px;
                              }
                              /* Bloquea transiciones durante reposicionamiento FLIP */
                              .logo-stage.no-transition {
                                  transition: none !important;
                              }

                              /* Logo principal */
                              .logo-main {
                                  flex-basis: 100%;
                                  max-width: 500px;
                                  display: block;
                                  filter: drop-shadow(0 8px 24px rgba(0,0,0,0.13));
                                  opacity: 0;
                                  animation: dropIn 0.9s cubic-bezier(0.22,1,0.36,1) 0.1s forwards;
                                  transition: max-width 0.8s cubic-bezier(0.4,0,0.2,1),
                                              flex-basis 0s 0s,
                                              filter 0.5s ease;
                              }
                              .welcome-wrapper.settled .logo-main {
                                  flex-basis: auto;
                                  max-width: 180px;
                                  filter: drop-shadow(0 2px 8px rgba(0,0,0,0.1));
                              }

                              /* Logos secundarios */
                              .logo-sec {
                                  width: 100px;
                                  height: 100px;
                                  object-fit: contain;
                                  filter: drop-shadow(0 4px 12px rgba(0,0,0,0.14));
                                  transition: width  0.8s cubic-bezier(0.4,0,0.2,1),
                                              height 0.8s cubic-bezier(0.4,0,0.2,1),
                                              filter 0.5s ease;
                              }
                              .logo-sec.logo-left  { opacity:0; animation: slideLeft  0.85s cubic-bezier(0.22,1,0.36,1) 0.5s forwards; }
                              .logo-sec.logo-right { opacity:0; animation: slideRight 0.85s cubic-bezier(0.22,1,0.36,1) 0.8s forwards; }
                              .welcome-wrapper.settled .logo-sec {
                                  width: 52px;
                                  height: 52px;
                                  filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
                              }

                              /* Sección de gráfica */
                              .chart-section {
                                  width: 100%;
                                  max-width: 900px;
                                  margin-top: 20px;
                                  background: #fff;
                                  border-radius: 14px;
                                  box-shadow: 0 4px 24px rgba(0,0,0,0.08);
                                  padding: 24px;
                                  opacity: 0;
                                  transform: translateY(24px);
                                  transition: opacity 0.6s ease, transform 0.6s ease;
                                  pointer-events: none;
                              }
                              .chart-section.visible {
                                  opacity: 1;
                                  transform: translateY(0);
                                  pointer-events: auto;
                              }

                              /* Responsive */
                              @media (max-width: 768px) {
                                  .logo-main { max-width: 300px; }
                                  .logo-sec  { width: 72px; height: 72px; }
                                  .welcome-wrapper.settled .logo-main { max-width: 130px; }
                                  .welcome-wrapper.settled .logo-sec  { width: 40px; height: 40px; }
                                  .welcome-wrapper.settled .logo-stage { padding: 12px 16px; gap: 16px; }
                              }
                              @media (max-width: 480px) {
                                  .logo-main { max-width: 220px; }
                                  .logo-sec  { width: 56px; height: 56px; }
                              }
                            </style>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="welcome-wrapper" id="welcomeWrapper">

            <div class="logo-stage" id="logoStage">
              <img src="images/img_grupo/gif_logo.png"      alt="PG Manage" class="logo-main">
              <img src="images/img_grupo/icono.png"          alt="Icono PG"  class="logo-sec logo-left">
              <img src="images/img_grupo/logo_sin_fondo.png" alt="Logo PG"   class="logo-sec logo-right">
            </div>

            <div class="chart-section" id="chartSection">
              <div id="chartPedidos"></div>
              <div id="chartTotal" style="text-align:right; margin-top:10px; font-size:14px; color:#7f8c8d; border-top:1px solid #e8ecf1; padding-top:10px;">
                Total: <strong id="totalPedidos" style="font-size:18px; color:#2c3e50;">—</strong>
              </div>
            </div>

          </div>
        </div>
        <!-- /page content -->

        <script>
          // Animaciones terminan ~1.65s (último logo: delay 0.8s + duración 0.85s)
          // Esperamos 2s más → 3.7s totales desde carga
          setTimeout(function() {
            var wrapper = document.getElementById('welcomeWrapper');
            var stage   = document.getElementById('logoStage');

            // FLIP: captura posición antes del cambio
            var before = stage.getBoundingClientRect();

            // Aplica clase settled (logos se mueven al top y cambian tamaño)
            wrapper.classList.add('settled');

            // FLIP: captura posición después del cambio
            var after = stage.getBoundingClientRect();
            var dy = before.top - after.top;

            if (dy !== 0) {
              // Bloquea transiciones y aplica transform inverso (stage parece estar en posición original)
              stage.classList.add('no-transition');
              stage.style.transform = 'translateY(' + dy + 'px)';

              // Fuerza reflow
              stage.getBoundingClientRect();

              // Habilita transición y anima hacia posición final
              stage.classList.remove('no-transition');
              stage.style.transition = 'transform 0.9s cubic-bezier(0.4,0,0.2,1)';
              stage.style.transform  = 'translateY(0)';

              // Limpia el inline transition una vez terminada la animación
              stage.addEventListener('transitionend', function onEnd(e) {
                if (e.propertyName !== 'transform') return;
                stage.removeEventListener('transitionend', onEnd);
                stage.style.transition = '';
                stage.style.transform  = '';
                mostrarGrafica();
              });
            } else {
              mostrarGrafica();
            }

          }, 2700);

          function mostrarGrafica() {
            var section = document.getElementById('chartSection');
            section.classList.add('visible');
            cargarGraficaPedidos();
          }

          function cargarGraficaPedidos() {
            var anio = new Date().getFullYear();
            $.post('ajax/welcome.php?op=pedidos_por_mes', { anio: anio }, function(resp) {
              var data    = JSON.parse(resp);
              var meses   = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
              var mesActual = new Date().getMonth() + 1;
              var totales     = new Array(12).fill(0);
              var entregados  = new Array(12).fill(0);
              var suma = 0;
              data.forEach(function(row) {
                totales[row.mes - 1]    = row.total;
                entregados[row.mes - 1] = row.entregados;
                suma += row.total;
              });
              document.getElementById('totalPedidos').textContent = suma;

              var totalesCurrent    = totales.slice(0, mesActual);
              var entregadosCurrent = entregados.slice(0, mesActual);
              var mesesCurrent      = meses.slice(0, mesActual);

              var options = {
                series: [
                  { name: 'Pedidos',    data: totalesCurrent    },
                  { name: 'Entregados', data: entregadosCurrent }
                ],
                chart: {
                  type: 'line',
                  height: 300,
                  toolbar: { show: false },
                  animations: {
                    enabled: true,
                    easing: 'linear',
                    speed: 400,
                    animateGradually: { enabled: true, delay: 130 }
                  },
                  events: {
                    animationEnd: function(ctx) {
                    ctx.updateOptions({ dataLabels: { enabled: true } }, false, false);
                    setTimeout(function() {
                      var wrap = document.querySelector('#chartPedidos');
                      if (!wrap) return;

                      var s0 = Array.from(wrap.querySelectorAll('.apexcharts-series[data-realindex="0"] .apexcharts-datalabel'));
                      var s1 = Array.from(wrap.querySelectorAll('.apexcharts-series[data-realindex="1"] .apexcharts-datalabel'));

                      // Separación base: pedidos arriba, entregados abajo
                      s0.forEach(function(el) {
                        el.setAttribute('y', parseFloat(el.getAttribute('y') || 0) - 14);
                      });
                      s1.forEach(function(el) {
                        el.setAttribute('y', parseFloat(el.getAttribute('y') || 0) + 14);
                      });

                      // Segundo paso: detecta solapamiento real y separa más si hace falta
                      s0.forEach(function(el0, i) {
                        var el1 = s1[i];
                        if (!el0 || !el1) return;
                        var r0 = el0.getBoundingClientRect();
                        var r1 = el1.getBoundingClientRect();
                        var gap = r1.top - r0.bottom; // positivo = no se tocan
                        if (gap < 4) {
                          var push = (4 - gap) / 2 + 2;
                          el0.setAttribute('y', parseFloat(el0.getAttribute('y')) - push);
                          el1.setAttribute('y', parseFloat(el1.getAttribute('y')) + push);
                        }
                      });
                    }, 150);
                  }
                  }
                },
                stroke:      { curve: 'smooth', width: 3 },
                markers:     { size: 5, hover: { size: 7 } },
                dataLabels: {
                  enabled: false,
                  formatter: function(v) { return v > 0 ? v : ''; },
                  style: {
                    fontSize: '11px',
                    fontWeight: '700',
                    colors: ['#2176ae', '#1a9e52']
                  },
                  background: { enabled: false },
                  dropShadow: {
                    enabled: true,
                    top: 0, left: 0,
                    blur: 4,
                    color: '#ffffff',
                    opacity: 1
                  }
                },
                xaxis:   { categories: mesesCurrent },
                yaxis:   { min: 0, labels: { formatter: function(v) { return Math.round(v); } } },
                colors:  ['#3498db', '#2ecc71'],
                title: {
                  text: 'Pedidos por mes — ' + anio,
                  align: 'left',
                  style: { fontSize: '14px', fontWeight: '600', color: '#2c3e50' }
                },
                grid:    { borderColor: '#e8ecf1' },
                tooltip: { y: { formatter: function(v) { return v + ' pedidos'; } } }
              };

              new ApexCharts(document.querySelector('#chartPedidos'), options).render();
            });
          }
        </script>


      </div>
    </div>


    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
   <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="vendors/google-code-prettify/src/prettify.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

    <script type="text/javascript" src="scripts/list_pedidos.js?v=<?php echo rand(); ?>"></script>
    <script src="public/js/bootbox.min.js"></script>

  </body>
</html>



<?php
}
ob_end_flush();
?>