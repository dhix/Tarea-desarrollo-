using Microsoft.AspNetCore.Mvc;
using System.Linq;
using System.Threading.Tasks;
using web_api_empresa.Models;
namespace web_api_empresa.Controllers{

    [Route("api/[controller]")]
    public class EmpleadosController : Controller {
       
        private Conexion dbConexion;

        
        public EmpleadosController() { 
            dbConexion = Conectar.Create();
        }

       
        [HttpGet]
        public ActionResult Get() {
            
             var query = from e in dbConexion.Empleados
                    join p in dbConexion.Puestos
                        on e.id_puesto equals p.id_puesto
                        select new Empleados{ id_empleado=e.id_empleado, codigo=e.codigo,nombres= e.nombres, apellidos = e.apellidos,
                          direccion = e.direccion, telefono = e.telefono, fecha_nacimiento = e.fecha_nacimiento,id_puesto=e.id_puesto,puesto= p};
            return Ok(query.ToList());
        }

        
        [HttpGet("{id}")]
        public async Task<ActionResult> Get(int id) {
            var empleados = await dbConexion.Empleados.FindAsync(id);
            if (empleados != null) {
                return Ok(empleados);
            } else {
                return NotFound();
            }
        }

      
        [HttpPost]
        public async Task<ActionResult> Post([FromBody] Empleados empleados) {
            if (ModelState.IsValid){
                dbConexion.Empleados.Add(empleados);
                await dbConexion.SaveChangesAsync();
                return Ok();
            } else {
                return BadRequest();
            }
        }

       
        public async Task<ActionResult> Put([FromBody] Empleados empleados){
            var v_empleados = dbConexion.Empleados.SingleOrDefault(c => c.id_empleado == empleados.id_empleado);
            if (v_empleados != null && ModelState.IsValid){
                dbConexion.Entry(v_empleados).CurrentValues.SetValues(empleados);
                await dbConexion.SaveChangesAsync();
                return Ok();
            } else {
                return BadRequest();
            }
        }


       
        [HttpDelete("{id}")]
        public async Task<ActionResult> Delete(int id) {
            var empleados = dbConexion.Empleados.SingleOrDefault(c => c.id_empleado == id);
            if (empleados != null) {
                dbConexion.Empleados.Remove(empleados);
                await dbConexion.SaveChangesAsync();
                return Ok();
            } else {
                return NotFound();
            }
        }
  }
}