using Microsoft.AspNetCore.Mvc;
using System.Linq;
using System.Threading.Tasks;
using web_api_empresa.Models;

namespace web_api_empresa.Controllers{
    [Route("api/[controller]")]
    public class ClientesController : Controller {
        
        private Conexion dbConexion;
        public ClientesController() { 
            dbConexion = Conectar.Create();
        }

      
        [HttpGet]
        public ActionResult Get() {
            return Ok(dbConexion.Clientes.ToArray());
        }

       
        [HttpGet("{id}")]
        public async Task<ActionResult> Get(int id) {
            var clientes = await dbConexion.Clientes.FindAsync(id);
            if (clientes != null) {
                return Ok(clientes);
            } else {
                return NotFound();
            }
        }

        
        [HttpPost]
        public async Task<ActionResult> Post([FromBody] Clientes clientes) {
            if (ModelState.IsValid){
                dbConexion.Clientes.Add(clientes);
                await dbConexion.SaveChangesAsync();
                return Ok();
            } else {
                return BadRequest();
            }
        }


        public async Task<ActionResult> Put([FromBody] Clientes clientes){
            var v_clientes = dbConexion.Clientes.SingleOrDefault(c => c.id_cliente == clientes.id_cliente);
            if (v_clientes != null && ModelState.IsValid){
                dbConexion.Entry(v_clientes).CurrentValues.SetValues(clientes);
                await dbConexion.SaveChangesAsync();
                return Ok();
            } else {
                return BadRequest();
            }
        }


        [HttpDelete("{id}")]
        public async Task<ActionResult> Delete(int id) {
            var clientes = dbConexion.Clientes.SingleOrDefault(c => c.id_cliente == id);
            if (clientes != null) {
                dbConexion.Clientes.Remove(clientes);
                await dbConexion.SaveChangesAsync();
                return Ok();
            } else {
                return NotFound();
            }
        }

    }
}