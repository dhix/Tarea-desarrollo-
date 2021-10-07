using Microsoft.AspNetCore.Mvc;
using System.Linq;
using System.Threading.Tasks;
using web_api_empresa.Models;
namespace web_api_empresa.Controllers{
    [Route("api/[controller]")]
    public class PuestosController : Controller {
       
        private Conexion dbConexion;

        
        public PuestosController() { 
            dbConexion = Conectar.Create();
        }

        [HttpGet]
        public ActionResult Get() {
            return Ok(dbConexion.Puestos.ToArray());
        }

        
        [HttpGet("{id}")]
        public async Task<ActionResult> Get(int id) {
            var Puestos = await dbConexion.Puestos.FindAsync(id);
            if (Puestos != null) {
                return Ok(Puestos);
            } else {
                return NotFound();
            }
        }

       
  }
}